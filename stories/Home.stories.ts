import { faker } from '@faker-js/faker'
import { Meta, StoryObj } from '@storybook/vue3'
import Home from '../resources/ts/Pages/Home.vue'

const meta: Meta<typeof Home> = {
    component: Home,
}

export default meta

export const Default: StoryObj<typeof Home> = {
    args: {
        user: {
            id: faker.string.uuid(),
            username: faker.string.alphanumeric({
                length: { max: 12, min: 6 },
            }),
            avatar: faker.image.urlPicsumPhotos(),
        },
        popularSides: Array(5)
            .fill(0)
            .map(() => ({
                id: faker.string.uuid(),
                name: faker.string.alphanumeric({
                    length: { max: 12, min: 6 },
                }),
                avatar: faker.image.avatar(),
            })),

        posts: Array(5)
            .fill(null)
            .map(() => ({
                id: faker.string.uuid(),
                title: faker.lorem.words({ min: 4, max: 8 }),
                body: faker.lorem.lines({ max: 12, min: 4 }),
                score: faker.number.int({ min: 10, max: 1_000_000 }),
                side: {
                    id: faker.string.uuid(),
                    name: faker.string.alphanumeric({
                        length: { max: 12, min: 6 },
                    }),
                    avatar: faker.image.urlLoremFlickr(),
                },
                author: {
                    id: faker.string.uuid(),
                    username: faker.string.alphanumeric({
                        length: { min: 4, max: 12 },
                    }),
                    avatar: faker.image.urlLoremFlickr(),
                },
                createdAt: faker.date
                    .recent({ days: 1000 })
                    .getUTCMilliseconds(),
                updatedAt: faker.date.recent({ days: 50 }).getUTCMilliseconds(),
            })),
    },
}

export const EmptySide: StoryObj<typeof Home> = {
    args: { ...Default.args, popularSides: [] },
}

export const EmptyPost: StoryObj<typeof Home> = {
    args: { ...Default.args, posts: [] },
}
