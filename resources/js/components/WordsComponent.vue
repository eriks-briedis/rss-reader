<template>
    <div class="container mb-4">
        <div class="row justify-content-center mb-3">
            <h1>Most frequent words</h1>
        </div>
        <div class="row justify-content-center">
            <ul class="list-group" style="width: 50%">
                <li class="list-group-item d-flex justify-content-between align-items-center" v-for="(count, word) in words">
                    {{ word }}
                    <span class="badge badge-primary badge-pill">{{ count }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            words: {
                type: Object,
                required: true
            }
        }
    }
</script>
