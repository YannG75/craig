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
                                @click="contact=!contact"
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
                <div class="bg-revert max-w-sm rounded overflow-hidden shadow-lg mt-10">
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
            <vs-dialog v-model="contact">
                <template #header>
                    <h4 class="not-margin">
                        Contact the Owner
                    </h4>
                </template>


                <div class="con-form">
                    <vs-input v-model="mail" placeholder="Email">
                        <template #icon>
                            @
                        </template>
                    </vs-input>
                    <textarea  v-model="message" placeholder="Your message" rows="5" cols="40">
                    </textarea>
                </div>

                <template #footer>
                    <div class="footer-dialog">
                        <vs-button style="margin-bottom: 10px" block @click="sendMail">
                            Envoyer
                        </vs-button>
                        <span v-if="error" style="color: red;">Une erreur est survenue, vérifie l'émail rentré 😉</span>
                        <span v-if="send" style="color: green">Ton message a bien été transmis 😉</span>
                    </div>
                </template>
            </vs-dialog>
            <qrcode-vue class="print-only" :value="urlValue" :size="size" level="H"></qrcode-vue>

        </div>
    </div>
</template>
<script>
    import Nav from "../Layouts/Nav";
    import moment from 'moment';
    import QrcodeVue from 'qrcode.vue'
    import axios from 'axios'
    export default {
        name: "Advert",
        data() {
            return {
                urlValue:window.location.href,
                size: 300,
                contact: false,
                mail: '',
                message: '',
                error: false,
                send: false
            }
        },
        components: {
            Nav,
            QrcodeVue
        },
        methods: {
            moment: function () {
                return moment();
            },

            print () {
                window.print()
            },

            sendMail() {

                axios.post('/contact', {mail: this.mail, message: this.message, ad: this.$page.advert}).then(res => {
                        this.send = true
                        this.error = false
                        setTimeout(() => {
                            this.contact = !this.contact
                            this.send = !this.send
                        }, 2000)
                })
                .catch(err => {
                    this.error = true
                })
            }

        }
    }
</script>

<style lang="stylus" >
    .cont {
        background: linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(228,231,236,1) 100%);
    }
    .print-only {
        display: none;
    }
    .bg-revert {
        background: linear-gradient(180deg, rgba(228,231,236,1) 0%, rgba(255,255,255,1) 100%);
    }
    .not-margin {
        margin: 0px;
        font-weight: normal;
        padding: 10px;
    }
    .con-form {
        width: 100%;
    }
    .con-form .flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .con-form .flex a {
        font-size: 0.8rem;
        opacity: 0.7;
    }
    .con-form .flex a:hover {
        opacity: 1;
    }
    .con-form .vs-checkbox-label {
        font-size: 0.8rem;
    }
    .con-form .vs-input-content {
        margin: 10px 0px;
        width: calc(100%);
    }
    .con-form .vs-input-content .vs-input {
        width: 100%;
    }
    .footer-dialog {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: calc(100%);
    }
    .footer-dialog .new {
        margin: 0px;
        margin-top: 20px;
        padding: 0px;
        font-size: 0.7rem;
    }
    .footer-dialog .new a {
        /*color: rgba(var(--vs-primary), 1) !important;*/
        margin-left: 6px;
    }
    .footer-dialog .new a:hover {
        text-decoration: underline;
    }
    .footer-dialog .vs-button {
        margin: 0px;
    }

    @media print{
        .print-only {
            margin-top: 150px;
            padding-top: 150px;
            display: block;
        }

        .h-250 {
            width: 320px;
        }
    }


</style>
