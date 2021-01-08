<template>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h1 class="my-4">Loja Virtual</h1>
                <div class="list-group">
                    <input v-model="search_post" placeholder="Pesquise..." class="list-group-item mb-1" v-on:input="getPost(search_post)">
                </div>
                <div class="list-group">
                    <a class="list-group-item selecionado" href="#" v-bind:class="[isActive==0 ? activeClass : '']" v-on:click="loadPosts">
                        Todos
                    </a>
                    <a class="list-group-item selecionado" href="#" v-bind:class="[isActive==category.id ? activeClass : '']" v-on:click="getCategory(category.id)" v-for="(category, index) in categories">
                        {{ category.title }}
                    </a>
                </div>
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" v-for="(item, index) in images" :key="index" data-slide-to=":key" v-bind:class="[index==0 ? 'active' : '']"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item" v-for="(item, index) in images" v-bind:class="[index==0 ? 'active' : '']">
                            <img class="d-block img-fluid" v-bind:src="/storage/ + item.photo" alt="">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <hr>
                <pagination v-if="isActive==0" class="col-12 justify-content-center" :data="laravelData" @pagination-change-page="loadPosts"></pagination>
                <div class="row p-5 justify-content-center">
                    <div class="" :class="{'loading' : loading}">
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4" v-for="post in posts">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top" v-bind:src="/storage/ + post.photo" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a v-bind:href="/post/ + post.slug">{{ post.title }}</a>
                                </h4>
<!--                                <h5>$24.99</h5>-->
                                <p class="card-text">{{ post.description }}</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->
<!--        <div class="row">-->
<!--            <div class="col-12">-->
<!--                <div id="instafeed"></div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    <!-- /.container -->
</template>
<script>
export default {
    name: "Front",
    data: function () {
        return {
            categories: [],
            images: [],
            posts: [],
            search_post: '',
            loading: true,
            page: 1,
            isActive: 0,
            activeClass: 'active',
            laravelData: {}
        }
    },
    // computed: {
    //     classObject: function () {
    //         return {
    //             active: this.isActive && !this.error,
    //             'text-danger': this.error && this.error.type === 'fatal'
    //         }
    //     }
    // },
    mounted() {
        this.loadCategories();
        this.loadPosts();
        this.loadSlides();
    },
    methods: {
        loadCategories: function () {
            //Carregar categorias
            axios.get('/api/categories')
            .then((response) => {
                this.categories = response.data.data
            })
            .catch(function (error){
                console.log(error)
            });
        },
        loadPosts: function (page = 1) {
            //Carregar postagens
            axios.get('/api/posts?page='+ page)
                .then((response) => {
                    this.isActive = 0
                    this.posts = response.data.data
                    this.laravelData = response.data
                    this.loading = false
                })
                .catch(function (error){
                    console.log(error)
                });
        },
        loadSlides: function () {
            //Carregar imagens
            axios.get('/api/slides')
                .then(response => {
                    console.log(response.data.data[0].photos)
                    this.images = response.data.data[0].photos;
                });
        },
        getCategory: function (category) {
            axios.get('/api/post/' + category)
                .then((response) => {
                    this.isActive = category
                    this.posts = response.data.data[0].posts

                })
                .catch(function (error){
                    console.log(error)
                });
        },
        getPost: function (evt){
            console.log(evt)
            axios.get('/api/post_search/' + evt)
                .then((response) => {
                    console.log(response)
                    this.isActive = -1
                    this.posts = response.data.data
                })
                .catch(function (error){
                    console.log(error)
                });
        },
    }
}
</script>

<style scoped>

</style>
