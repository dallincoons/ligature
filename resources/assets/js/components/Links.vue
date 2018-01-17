<template>
    <div class="section-container">
        <div class="side-section">
            <div class="nav-section">
                <h1 class="block-brand">
                    <span>BRAIN</span>
                    <span>FRAME</span>
                    <span>RECALL</span>
                </h1>

                <a style="cursor: pointer;" class="right-link"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </div>

            <div class="side-card">
                <div class="form-section">
                    <label class="main-label">URL</label>
                    <input type="text" placeholder="Copy & Paste Url" @keyup="getHeader()" v-model="url" class="main-input">
                </div>
                <div class="form-section">
                    <label class="main-label">DESCRIPTION</label>
                    <input class="main-input" placeholder="What is this link about?" v-model="description">
                </div>
                <a class="main-button hvr-bounce-to-right link-button" @click="saveLink">Save Link</a>
            </div>

        </div>
        <div class="main-section">
            <div class="sub-heading">
                <div>
                    <h2>MY LINKS</h2>
                </div>
                <div class="search-section">
                    <input @keyup.enter="search($event)" placeholder="Looking for something?" class="sub-input">
                    <span class="span-button hvr-bounce-to-right " @click="search($event)">Search</span>
                </div>

            </div>
            <div v-for="link in links" class="link-section">
                <div class="link-items">
                    <div class="link-item">
                        <a :href="link.url" target="_blank" class="main-link">{{link.description}}</a>
                        <a :href="link.url" target="_blank" class="truncate sub-link">{{link.url}}</a>
                    </div>
                    <span @click="deleteLink(link.id)" class="delete-link">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 59 59" style="enable-background:new 0 0 59 59;" xml:space="preserve" width="18px" height="18px">
<g>
	<path d="M29.5,51c0.552,0,1-0.447,1-1V17c0-0.553-0.448-1-1-1s-1,0.447-1,1v33C28.5,50.553,28.948,51,29.5,51z" fill="#363636"/>
	<path d="M19.5,51c0.552,0,1-0.447,1-1V17c0-0.553-0.448-1-1-1s-1,0.447-1,1v33C18.5,50.553,18.948,51,19.5,51z" fill="#363636"/>
	<path d="M39.5,51c0.552,0,1-0.447,1-1V17c0-0.553-0.448-1-1-1s-1,0.447-1,1v33C38.5,50.553,38.948,51,39.5,51z" fill="#363636"/>
	<path d="M52.5,6H38.456c-0.11-1.25-0.495-3.358-1.813-4.711C35.809,0.434,34.751,0,33.499,0H23.5c-1.252,0-2.31,0.434-3.144,1.289   C19.038,2.642,18.653,4.75,18.543,6H6.5c-0.552,0-1,0.447-1,1s0.448,1,1,1h2.041l1.915,46.021C10.493,55.743,11.565,59,15.364,59   h28.272c3.799,0,4.871-3.257,4.907-4.958L50.459,8H52.5c0.552,0,1-0.447,1-1S53.052,6,52.5,6z M21.792,2.681   C22.24,2.223,22.799,2,23.5,2h9.999c0.701,0,1.26,0.223,1.708,0.681c0.805,0.823,1.128,2.271,1.24,3.319H20.553   C20.665,4.952,20.988,3.504,21.792,2.681z M46.544,53.979C46.538,54.288,46.4,57,43.636,57H15.364   c-2.734,0-2.898-2.717-2.909-3.042L10.542,8h37.915L46.544,53.979z" fill="#363636"/>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>

                    </span>
                </div>


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
