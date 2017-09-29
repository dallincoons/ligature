<template>
    <div class="container is-fluid">
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="field">
                    <label class="label">Url</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Put something here" @keyup="getHeader()" v-model="url">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Description</label>
                    <div class="control">
                        <input class="input" placeholder="Put stuff here" v-model="description">
                    </div>
                </div>
                <a class="button is-white" @click="saveLink">Save</a>
            </div>
        </section>
        <div class="panel">
            <div class="panel-heading">
                Links <input @keyup.enter="search($event)" placeholder="search">
            </div>
            <div class="panel-block is-active control has-icons-right" v-for="link in links">
                <a :href="link.url" target="_blank">{{link.description}}</a>
                <span @click="deleteLink(link.id)" style="pointer-events:auto;" class="icon is-large is-right is-clickable">X</span>
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
