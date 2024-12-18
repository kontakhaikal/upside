<?php

namespace App\Services;

use App\Dto\CreateSideRequest;
use App\Dto\Side\PopularSideData;
use App\Dto\Side\JoinedSideData;
use App\Dto\Side\SideData;
use App\Exceptions\AlreadyJoinedSideException;
use App\Exceptions\SideNotFoundException;
use App\Models\Membership;
use App\Models\Role;
use App\Models\Side;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\DataCollection;

class SideService
{
    public function createSide(User $user, CreateSideRequest $req): string
    {
        return DB::transaction(function () use ($user, $req) {
            $side = new Side();
            $side->id = $req->id;
            $side->name = $req->name;
            $side->description = $req->description;

            $side->save();

            $membership = new Membership();
            $membership->role = Role::ADMIN;
            $membership->user()->associate($user);
            $membership->side()->associate($side);

            $membership->save();

            return $side->id;
        });
    }

    public function getSideDetail(string $sideId): SideData
    {
        $side = Side::with('posts.membership.user')
            ->find($sideId)
            ->firstOr(callback: fn() => throw new SideNotFoundException());
        return SideData::fromSideModel($side);
    }

    /**
     * @return \Spatie\LaravelData\DataCollection<PopularSideData>
     */
    public function getPopularSides(User|null $user): DataCollection
    {
        $popularSides = Side::popularSides();

        if ($user == null) {
            return PopularSideData::collect(
                $popularSides,
                DataCollection::class
            );
        }

        $popularSidesData = $popularSides->map(
            fn(Side $side) => new PopularSideData(
                $side->id,
                $side->hasMemberOfUser($user)
            )
        );

        return PopularSideData::collect(
            $popularSidesData,
            DataCollection::class
        );
    }

    /**
     * @param \App\Models\User $user
     * @return \Spatie\LaravelData\DataCollection<JoinedSideData>
     */
    public function getJoinedSides(User $user): DataCollection
    {
        $joinedSides = Side::joinedSides($user->id);
        return JoinedSideData::collect($joinedSides, DataCollection::class);
    }

    public function joinSide(User $user, string $sideId)
    {

        $side = Side::where('id', $sideId)
            ->firstOr(fn() => throw new SideNotFoundException());

        if ($side->hasMemberOfUser($user)) {
            throw new AlreadyJoinedSideException();
        }

        $membership = new Membership();
        $membership->role = Role::MEMBER;

        $membership->user()->associate($user);
        $membership->side()->associate($side);

        $membership->save();

        return $side->id;
    }
}
