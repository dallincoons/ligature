<template>
    <div class="container">

        <div class="side-section">
            <label>Url</label>
            <input type="text" placeholder="Copy & Paste Url" @keyup="getHeader()" v-model="url">
            <label>Description</label>
            <input class="input" placeholder="What is this link about?" v-model="description">
            <a @click="saveLink">Save Link</a>
        </div>
        <div class="main-section">
            <div>
                My Links <input @keyup.enter="search($event)" placeholder="search">
            </div>
            <div v-for="link in links">
                <a :href="link.url" target="_blank">{{link.description}}</a>
                <span @click="deleteLink(link.id)">X</span>
            </div>
            <nav class="pagination" aria-label="pagination">
                <a class="pagination-previous" @click="previousPage" v-show="previousPageUrl">Previous</a>
                <a class="pagination-next" @click="nextPage" v-show="nextPageUrl">Next page</a>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                url         : '',
                description : '',
                links       : [],
                nextPageUrl : '',
                previousPageUrl : ''
            }
        },
        created() {

            this.getLinks('/api/links');

            this.getHeader = _.debounce(this.getHeader, 750);
        },
        methods : {

            getLinks(url) {
                axios.get(url).then(response => {
                    this.links = response.data.data;
                    this.nextPageUrl = response.data.next_page_url;
                    this.previousPageUrl = response.data.prev_page_url;
                });
            },

            nextPage() {
                this.getLinks(this.nextPageUrl);
            },

            previousPage() {
                this.getLinks(this.previousPageUrl);
            },

            getHeader() {
                axios.post('/api/url-check', {
                    url : this.url
                }).then((response) => {
                    this.description = response.data.heading;
                    this.url = response.data.url;
                });
            },

            saveLink() {
                axios.post('/api/links', {
                    'url'         : this.url,
                    'description' : this.description,
                }).then(response => {
                    this.links = response.data;
                    this.url = '';
                    this.description = '';
                });
            },

            deleteLink(id) {
                axios.delete('/api/links/' + id).then(response => {
                    this.links = response.data;
                });
            },

            search(e) {
                let input = e.target.value;
                axios.get('/api/links/search?query=' + input).then(response => {
                    this.links = response.data;
                });
            }
        }
    }
</script>
