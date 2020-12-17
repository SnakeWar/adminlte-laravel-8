<template>
    <!-- Page Content -->

    <div class="container">

        <div class="row">

            <div class="col-lg-3">

                <h1 class="my-4">Shop Name</h1>
                <div class="list-group">
                    <a class="list-group-item selecionado negrito" v-on:click="loadPosts">
                        Todos
                    </a>
                    <a class="list-group-item selecionado" v-on:click="getCategory(index)" v-for="(category, index) in categories">
                        {{ category.name }}
                    </a>
                </div>

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
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

                <div class="row p-5">
<!--                    <div class="" :class="{'loading' : loading}">-->

<!--                    </div>-->
                    <div class="col-lg-4 col-md-6 mb-4" v-for="post in posts">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top" v-bind:src="/storage/ + post.photo" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#">{{ post.title }}</a>
                                </h4>
<!--                                <h5>$24.99</h5>-->
                                <p class="card-text">{{ post.description }}</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>
<!--                    <infinite-loading @distance="1" @infinite="infiniteHandler"></infinite-loading>-->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</template>

<script>
export default {
    name: "Front",
    data: function () {
        return {
            categories: [],
            posts: [],
            loading: true,
            page: 1
        }
    },
    mounted() {
        this.loadCategories();
        this.loadPosts();
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
        loadPosts: function () {
            //Carregar postagens
            axios.get('/api/posts')
                .then((response) => {
                    this.posts = response.data.data
                    this.loading = false
                })
                .catch(function (error){
                    console.log(error)
                });
        },
        getCategory: function (category) {
            category = category+1;
            axios.get('/api/post/' + category)
                .then((response) => {
                    this.posts = response.data.data[0].posts

                })
                .catch(function (error){
                    console.log(error)
                });
        },
        infiniteHandler($state) {
            this.$http.get('/api/posts?page='+this.page)
                .then(response => {
                    return response.json();

                }).then(data => {
                $.each(data.data, (key, value)=> {
                    this.posts.push(value);
                });
                $state.loaded();
            });

            this.page = this.page + 1;
        },
    }
}
</script>

<style scoped>

</style>
