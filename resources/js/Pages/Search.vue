<template>
    <div class="cont min-h-screen pb-8">
        <Nav/>
        <div class="h-full pt-24">
            <h1 class="text-6xl text-center mb-8">{{$page.title.charAt(0).toUpperCase() + $page.title.slice(1)}}</h1>
            <section v-if="$page.adverts.total !== 0" class=" w-4/5 grid grid-cols-2 gap-8 justify-items-auto justify-center m-auto pb-2 mb-5">
                <inertia-link v-for="(advert, index) in $page.adverts.data"
                              :href="advert.sub_category? `/${advert.city_slug}/${advert.category_slug}/${advert.sub_category_slug}/advert/${advert.slug}` : `/${advert.city_slug}/${advert.category_slug}/advert/${advert.slug}`"
                              :key="index"
                              class="m-auto"
                >
                    <vs-card type="5" class="advert">
                        <template #title>
                            <h3>{{advert.title}}</h3>
                        </template>
                        <template #img>
                            <img :src="advert.picture" alt="">
                        </template>
                        <template #text>
                            <p>
                                {{advert.description}}
                            </p>
                        </template>
                    </vs-card>
                </inertia-link>
            </section>
            <h2 v-else class="text-4xl text-center mb-8">Pas d'annonce Trouvée  🤷</h2>
            <vs-pagination class="w-3/4 m-auto" color="dark" progress v-model="page" :length="$page.adverts.last_page" />
        </div>
    </div>
</template>

<script>
    import {Inertia} from "@inertiajs/inertia";
    import Nav from "../Layouts/Nav";

    export default {
        name: "Search",
        data() {
            return {
                page: this.$page.adverts.current_page
            }
        },
        components: {
          Nav
        },
        mounted() {
        },
        watch: {
            page: function (val) {
                Inertia.visit("http://127.0.0.1:8000/search/"+this.$page.title+"?page="+ val, {methode: 'get'})
            },
        }
    }
</script>

<style lang="stylus" scoped>
    .cont {
        background: linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(228,231,236,1) 100%);
    }
    .advert >>> div {
        background: transparent;
    }
    .advert >>> img {
        min-height: 350px;
        max-height: 450px;
        object-fit: cover;
    }
</style>
