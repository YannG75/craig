<template>
    <div class="cont min-h-screen pb-8">
        <Nav/>
        <div class="h-full pt-24">
            <section class="w-3/4 m-auto">
                <h1 class="text-2xl my-8 text-gray-500">{{$page.advert.title}}</h1>
                <article class="flex justify-between ">
                    <img class="shadow-2xl h-250" :src="$page.advert.picture" alt="">
                    <div>
                        <div class="flex flex-col sticky top-12">
                            <vs-button
                                block
                                gradient
                                color="#2ea5dd"
                            >
                                <box-icon name='contact' type='solid' color='#ffffff' ></box-icon> Contact the Owner
                            </vs-button>

                            <vs-button
                                block
                                shadow
                                @click="print"
                            >
                                <box-icon name='printer'></box-icon> Imprimer
                            </vs-button>

                            <vs-button
                                block
                                color="tumblr"
                            >
                                <box-icon name='low-vision' color='#ffffff' ></box-icon> Masquer
                            </vs-button>

                            <vs-button
                                gradient
                                block
                                warn
                                animation-type="scale"
                            >
                                Favoris
                                <template #animate >
                                    <box-icon name='star' color='#deecf2' ></box-icon>
                                </template>
                            </vs-button>

                            <vs-button
                                block
                                color="discord"
                            >
                                <box-icon name='share' color='#ffffff' ></box-icon> partager
                            </vs-button>

                        </div>
                    </div>

                </article>
                <div class="max-w-sm rounded overflow-hidden shadow-lg mt-10">
                    <div class="px-6 py-4">
                        <span class="text-gray-400 text-sm">{{moment($page.advert.created_at).format('MMMM Do YYYY, h:mm:ss a')}}</span>
                        <p class="text-gray-700 text-base">
                            {{$page.advert.description}}
                        </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{$page.advert.city}}</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{$page.advert.category}}</span>
                        <span v-if="$page.advert.sub_category !== null" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{$page.advert.sub_category}}</span>
                    </div>
                </div>
            </section>

            <qrcode-vue class="print-only" :value="urlValue" :size="size" level="H"></qrcode-vue>

        </div>
    </div>
</template>
<script>
    import Nav from "../Layouts/Nav";
    import moment from 'moment';
    import QrcodeVue from 'qrcode.vue'
    export default {
        name: "Advert",
        data() {
            return {
                urlValue:window.location.href,
                size: 300
            }
        },
        components: {
            Nav,
            QrcodeVue
        },
        mounted() {
            console.log(this.$page.advert)
        },
        methods: {
            moment: function () {
                return moment();
            },

            print () {
                window.print()
            }

        }
    }
</script>

<style lang="stylus" scoped>
    .cont {
        background: linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(228,231,236,1) 100%);
    }
    .print-only {
        display: none;
    }

    @media print{
        .print-only {
            margin-top: 40px;
            padding-top: 150px;
            display: block;
        }

        .h-250 {
            width: 320px;
        }
    }


</style>
