<template>
    <div id="detail">
        <!-- loader -->
        <div v-if="!loaded" class="text-center mt-5">
            <Loader />
        </div>
        <div v-else>
            <div class="d-flex justify-content-between">
                <h1>{{ post.title }}</h1>
                <span
                    v-if="post.category"
                    class="badge badge-success custom-badge"
                    >{{ post.category.name }}</span
                >
            </div>
            <i>{{ FormatDate.format(post.created_at) }}</i>
            <p>{{ post.content }}</p>
            <div>
                <i
                v-for="tag in post.tags"
                :key="'t' + tag.id">
                {{ tag.name }}
                </i>
            </div>
            <div class="mt-2">
                <router-link
                class="btn btn-warning"
                :to="{ name: 'blog' }"
                >Back
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import FormatDate from '../classes/FormatDate';
import Loader from "../components/Loader.vue";
export default {
    name: "PostDetail",
    components: {
        Loader
    },
    data() {
        return {
            post: {},
            FormatDate,
            loaded: false
        };
    },
    mounted() {
        axios
            .get("http://127.0.0.1:8000/api/posts/" + this.$route.params.slug)
            .then(res => {
                if (res.data.success) {
                    this.post = res.data.result;
                } else {
                    // se la pagina non esiste redirect alla pagina error404
                    this.$router.push({ name: "error404" });
                }
                this.loaded = true;
            })
            .catch(err => {
                console.log(err);
            });
    }
};
</script>

<style lang="scss" scoped>
#detail {
    height: 80vh;
}
i {
    display: inline-block;
    padding-right: 10px;
}
.custom-badge {
    display: inline-block;
    height: 2rem;
    line-height: 2rem;
}
</style>
