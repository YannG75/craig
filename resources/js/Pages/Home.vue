<template>
    <div class="cont min-h-screen">
        <Nav/>
      <div class="h-full pt-24" >
          <div class="w-4/5 flex justify-center m-auto">
              <vs-input
                type="search"
                v-model="search"
                icon-after
                placeholder="Search"
                @keypress.enter="searchFunc"
            >
                <template #icon>
                    <box-icon name='search-alt'></box-icon>
                </template>
            </vs-input>
          </div>


            <article class="cities-grid">
                <inertia-link v-for="(city, index) in $page.cities" :key="index" :href="route('City', { city : city.slug})">
                    <vs-card class="test" type="1" :key=index>
                        <template #title>
                            <h3>{{city.name}}</h3>
                        </template>
                        <template #img>
                            <img class="fit" :src="city.picture" alt="">
                        </template>
                        <template #text>
                            <p>
                                {{city.code}}
                            </p>
                        </template>
                    </vs-card>
                </inertia-link>

            </article>
      </div>

    </div>
</template>
<script>
import Nav from "../Layouts/Nav";
import {Inertia} from "@inertiajs/inertia";
export default {
data() {
        return {
            search: ''
        }
    },
    components: {
            Nav
    },
    methods: {
    searchFunc() {
        Inertia.visit ('/search/'+this.search+'', {method: 'get'})
    }
    }

}
</script>
<style lang="stylus">
.cont {
    background: linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(228,231,236,1) 100%);
}

    .cities-grid {
        display: grid;
        justify-content: center;
        grid-gap: 50px;
        grid-template-columns: repeat(auto-fit, 240px);
        padding: 20px;
    }
    .test {
        .vs-card .vs-card__img {
            max-height: 150px;
            background: aliceblue;
        }
        img {
            min-height: 150px;
            object-fit: cover;
        }
    }

</style>
