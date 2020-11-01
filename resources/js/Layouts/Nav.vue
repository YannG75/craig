<template>
    <vs-navbar fixed padding-scroll center-collapsed>
        <template #left>
            <inertia-link :href="route('Home')">
            <h1 class="text-lg">Craiglist</h1>
            </inertia-link>
        </template>
        <template #right>
            <a v-if="$page.user === null" :href="route('login')">
                    <vs-button
                        shadow
                        :active="active == 0"
                        @click="active = 0"
                    >
                        Login
                    </vs-button>
            </a>
                <a v-else :href="route('dashboard')">
                    <vs-button
                        shadow
                        :active="active == 0"
                        @click="active = 0"
                    >
                        {{$page.user.name}}
                    </vs-button>
                </a>

                    <vs-button
                        v-if="$page.user"
                    icon
                    shadow
                    :active="active == 0"
                    @click="[active = 0, logout()]"
                    >
                        <box-icon name='power-off' color='#ff4141' ></box-icon>
                    </vs-button>

            <a v-else :href="route('register')">
            <vs-button
                shadow
                :active="active == 1"
                @click="[active = 1, register()]"
            >
                Register
            </vs-button>
            </a>
        </template>
    </vs-navbar>
</template>

<script>
    import {Inertia} from '@inertiajs/inertia'
    export default {
        name: "Nav",
        data() {
            return {
                active : 1,
            }
        },
        mounted() {
        },
        methods: {
            logout() {
                axios.post(route('logout').url()).then(response => {
                    window.location = '/';
                })
            },
        }
    }
</script>

<style lang="css" scoped>
    .vs-button--gradient.vs-button--active.vs-button.vs-button--active {
        outline: none;
        background: #1e0f68;
    }
</style>
