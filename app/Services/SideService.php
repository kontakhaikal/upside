<?php

namespace App\Services;

use App\Dto\CreateSideRequest;
use App\Dto\MembershipData;
use App\Dto\PopularSideData;
use App\Dto\JoinedSideData;
use App\Dto\SideDetailData;
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

    public function getSideDetail(string $sideId): SideDetailData
    {
        $side = Side::with('posts')->find($sideId)->first();
        return SideDetailData::from($side);
    }

    /**
     * @return \Spatie\LaravelData\DataCollection<\App\Dto\PopularSideData>
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
                $side->isUserMembership($user->id)
            )
        );

        return PopularSideData::collect(
            $popularSidesData,
            DataCollection::class
        );
    }

    /**
     * @param \App\Models\User $user
     * @return \Spatie\LaravelData\DataCollection
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

        if ($side->isUserMembership($user->id)) {
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
