<template>
    <div class="container">
        <div class="row justify-content-center mb-4">
            <h1>Articles</h1>
        </div>
        <div v-for="article in articles" class="row py-3 mb-3 border bg-white">
            <div class="col-12">
                <h3 class="border-bottom pb-2 mb-2">{{ article.title }}</h3>
                <em v-if="article.author">{{ article.author.name }}</em>
                <p v-html="article.summary"></p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            articles: {
                type: Array,
                required: true
            }
        }
    }
</script>