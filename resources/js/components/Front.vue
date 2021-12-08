<template>
    <!-- Page Content -->
    <div class="container-fluid px-0">
        <div class="row">
            <!-- <div class="col-lg-12">
                <h1 class="my-4 text-center">Loja Virtual</h1>
            </div> -->
            <div class="col-lg-12 mt-0">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" v-for="(item, index) in images" :key="index" data-slide-to=":key" v-bind:class="[index==0 ? 'active' : '']"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item" className="slide-superior" v-for="(item, index) in images" v-bind:class="[index==0 ? 'active' : '']">
                            <img class="d-block img-fluid" v-bind:src="'/adminlte-laravel-8/public/storage/' + item.photo" alt="">
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
                <hr class="mt-3">
            </div>
    </div>
    <div class="container">
                <!-- <pagination v-if="isActive==0" class="col-12 justify-content-center" :data="laravelData" @pagination-change-page="loadPosts"></pagination> -->
                <div class="row justify-content-center mt-3">
                    <!-- pesquisa -->
                    <div class="col-lg-6">
                        <div class="list-group">
                            <input v-model="search_post" placeholder="Pesquise..." class="list-group-item mb-1" v-on:input="getPost(search_post)">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <!-- <button class="list-group-item selecionado" href="#" v-bind:class="[isActive==0 ? activeClass : '']" v-on:click="loadPosts">
                                Todos
                            </button>
                            <button class="list-group-item selecionado" href="#" v-bind:class="[isActive==category.id ? activeClass : '']" v-on:click="getCategory(category.id)" v-for="(category, index) in categories">
                                {{ category.title }}
                            </button> -->
                            <select class="custom-select custom-select-lg" v-on:change="changeItem($event)">
                                <option v-bind:value="'Todos'">Todos</option>
                                <option v-for="(category, index) in categories" v-bind:value="category.id">{{  category.title  }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.pesquisa -->
                    <div class="" :class="{'loading' : loading}">
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-12 mb-4 mt-3" v-for="post in posts">
                        <div class="card h-100">
                            <img class="card-img-top" v-bind:src="'/adminlte-laravel-8/public/storage/' + post.photo" alt="">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a class="stretched-link" v-bind:href="'/adminlte-laravel-8/public/postagem/' + post.slug">{{ post.title }}</a>
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
                <div class="col-lg-12 text-center my-5">
                                       <!-- <pagination v-if="isActive==0" class="col-12 justify-content-center" :data="laravelData" @pagination-change-page="loadPosts"></pagination>
                                       <infinite-loading @distance="1" @infinite="handleLoadMore"></infinite-loading> -->
                    <button v-if="loadmoreButton == true" class="btn btn-primary" v-on:click="handleLoadMore">Carregar Mais</button>
                </div>
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
            //last_page: 2,
            isActive: 0,
            activeClass: 'active',
            laravelData: {},
            loadmoreButton: true,
            selected: "",
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
            axios.get(window.location.href+'api/categories')
            .then((response) => {
                this.categories = response.data.data
            })
            .catch(function (error){
                console.log(error)
            });
        },
        loadPosts: function (page = 1) {
            //Carregar postagens
            axios.get(window.location.href+'api/posts?page='+ page)
                .then((response) => {
                    this.isActive = 0
                    this.page = 2;
                    this.posts = response.data.data
                    this.laravelData = response.data
                    this.loading = false
                    this.loadmoreButton = true
                    //console.log(this.posts.length)
                })
                .catch(function (error){
                    console.log(error)
                });
        },
        loadSlides: function () {
            //Carregar imagens
            axios.get(window.location.href+'api/slides')
                .then(response => {
                    //console.log(response.data.data[0].photos)
                    this.images = response.data.data[0].photos;
                });
        },
        getCategory: function (category) {
            axios.get(window.location.href+'api/post/' + category)
                .then((response) => {
                    this.loadmoreButton = false
                    this.isActive = category
                    //console.log(this.isActive)
                    this.posts = response.data.data[0].posts
                })
                .catch(function (error){
                    console.log(error)
                });
        },
        getPost: function (evt){
            //console.log(evt)
            if(evt.target.value === ""){
                this.loadPosts();
            }
            else{
                axios.get(window.location.href+'api/post_search/' + evt)
                    .then((response) => {
                        //console.log(response)
                        this.isActive = -1
                        this.loadmoreButton = false
                        this.posts = response.data.data
                    })
                    .catch(function (error){
                        console.log(error)
                    });
            }
        },
        changeItem: function changeItem(event) {
            if(event.target.value == "Todos"){
                this.loadPosts();
            }
            else{

            // this.selected = "target.value: " + event.target.value;
            // console.log(this.selected);
            axios.get(window.location.href+'api/post/' + event.target.value)
                .then((response) => {
                    this.loadmoreButton = false
                    this.isActive = event.target.value
                    //console.log(this.isActive)
                    this.posts = response.data.data[0].posts
                })
                .catch(function (error){
                    console.log(error)
                });
            }
            
        },
        handleLoadMore: function () {
            axios.get(window.location.href+'api/posts?page=' + this.page)
                .then(res => {
                    //console.log(res.data.meta.current_page);
                $.each(res.data.data, (key, value) => {
                    this.posts.push(value);
                });
                this.last_page = res.data.meta.last_page;
                //console.log(this.page)
                //if(this.page == this.last_page) this.isActive = 99999999
            });
            if(this.page < this.last_page){
                this.page = this.page + 1;
            }
            if(this.page == this.last_page){
                this.loadmoreButton = false
            }
        },
    }
}
</script>

<style scoped>
.carousel-item {
    max-height: 600px !important;
}
.carousel-item img{
    object-fit: cover;
}
.card img {
    max-height: 200px;
}
.card img {
    object-fit: cover;
}
</style>