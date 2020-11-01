<template>
    <div class="cont min-h-screen">
        <Nav/>
        <div class="h-full pt-24">
            <h1 class="text-6xl text-center mb-8">{{$page.cityName.charAt(0).toUpperCase() + $page.cityName.slice(1)}}</h1>
            <section class="w-4/5 grid grid-cols-3 gap-4 justify-items-auto m-auto pb-5">
                <div class="rounded bg-white overflow-hidden shadow-lg" v-for="(category, index) in $page.categories" :key="index">
                    <article class="w-3/4 py-6 border-b-2 border-gray-200 m-auto mb-3">
                        <inertia-link class="hover:text-purple-600" :href="`${$page.citySlug}/${category.slug}`">
                            <h4 class="text-3xl text-center">{{category.name}}</h4>
                        </inertia-link>
                    </article>
                    <div class="px-6 py-4 grid grid-cols-2 gap-4 justify-items-auto">
                        <inertia-link class="hover:underline hover:text-purple-600" v-for="(sub, index) in category.sub" :key="index" :href="`${$page.citySlug}/${category.slug}/${sub.slug}`">
                        <span class="text-gray-500 text-lg" >
                                {{sub.name}}
                        </span>
                        </inertia-link>
                    </div>
                </div>
            </section>
        </div>
    </div>

</template>

<script>
    import Nav from "../Layouts/Nav";
    export default {
        name: "City",
        mounted() {
        },
        components: {
            Nav
        }
    }
</script>

<style lang="stylus">
.cont {
    background: linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(228,231,236,1) 100%);
}

</style>
