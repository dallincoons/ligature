<template>
    <div class="section-container">
        <div class="side-section">
            <div class="nav-section">
                <h1 class="block-brand">
                    <span>BRAIN</span>
                    <span>FRAME</span>
                    <span class="brand-end">RECALL
                        <a style="cursor: pointer;" class="right-link"
                           onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    </span>

                </h1>



            </div>

            <div class="side-card">
                <div class="form-section">
                    <label class="main-label">URL</label>
                    <v-touch v-on:tap="getHeader"> <input type="text" placeholder="Copy & Paste Url" @keyup="getHeader()" v-model="url" class="main-input"> </v-touch>
                </div>
                <div class="form-section">
                    <label class="main-label">DESCRIPTION</label>
                    <input class="main-input" placeholder="What is this link about?" v-model="description" :disabled="!descriptionAllowed">
                </div>
                <a class="main-button hvr-bounce-to-right link-button" @click="saveLink">Save Link</a>
                <p class="error-message" :class="{'error' : hasError}">{{errorMessage}}</p>
            </div>

        </div>
        <div class="main-section">
            <div class="sub-heading">
                <div>
                    <h2>MY LINKS</h2>
                </div>
                <div class="search-section">
                    <input @keyup.enter="search($event)" v-model="searchInput" @focus="showClearInput = true" @focusout="showClearInput = false" placeholder="Looking for something?" class="sub-input">
                    <span @click="clearSearch()" class="clearInput" :class="{clearInputVisible : showClearInput }">x</span>
                    <span class="span-button hvr-bounce-to-right " @click="search($event)">Search</span>
                </div>

            </div>
            <div class="link-wrapper">
                <div v-for="link in links" class="link-section">
                    <div class="link-items">
                        <div class="link-item" v-show="!editable[link.id]">
                            <a :href="link.url" target="_blank" class="main-link">{{link.description}}</a>
                            <a :href="link.url" target="_blank" class="truncate sub-link">{{link.url}}</a>
                        </div>
                        <div class="edit-link" v-show="editable[link.id]">
                            <input type="text" v-model="link.description" class="main-input main-link"/>
                            <input type="text" v-model="link.url" class="main-input sub-link" />
                            <button v-show="editable" @click="updateLink(link)" class="edit-button hvr-bounce-to-right">Update Link</button>
                        </div>
                        <div class="link-options-wrapper">
                            <div class="link-options" @click="toggleOptionModual(link.id)">...</div>
                            <div class="modify-options" v-bind:class="{ visible: optionsVisible[link.id]}">
                            <span class="modify-option" @click="editable[link.id] = !editable[link.id]">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" class="edit-icon">
	                            <title>pencil</title>
	                            <g id="Layer_2" data-name="Layer 2">
		                            <g id="pencil">
                                        <path class="cls-1" d="M17.45,2.16,15.82.53a1.91,1.91,0,0,0-2.65,0L1.61,12.09a.39.39,0,0,0-.1.16L0,17.5a.38.38,0,0,0,.1.37A.39.39,0,0,0,.38,18h.1l5.25-1.5a.34.34,0,0,0,.16-.1L17.45,4.81A1.86,1.86,0,0,0,18,3.49,1.83,1.83,0,0,0,17.45,2.16Zm-.53,2.12L5.43,15.77.92,17.06l1.29-4.51L13.7,1.06a1.16,1.16,0,0,1,1.59,0l1.63,1.63A1.12,1.12,0,0,1,16.92,4.28Z"></path>
                                        <path class="cls-1" d="M17.45,2.16,15.82.53a1.91,1.91,0,0,0-2.65,0L1.61,12.09a.37.37,0,1,0,.53.53L13.7,1.06a1.16,1.16,0,0,1,1.59,0l1.63,1.63a1.12,1.12,0,0,1,0,1.59L5.36,15.84a.37.37,0,0,0,0,.53.35.35,0,0,0,.27.11.34.34,0,0,0,.26-.11L17.45,4.81A1.88,1.88,0,0,0,17.45,2.16Z"></path>
                                        <path class="cls-1" d="M5.89,15.84,2.14,12.09a.39.39,0,0,0-.53,0,.37.37,0,0,0,0,.53l3.75,3.75a.35.35,0,0,0,.27.11.34.34,0,0,0,.26-.11A.37.37,0,0,0,5.89,15.84Z"></path>
                                        <path class="cls-1" d="M15.64,2.34a.39.39,0,0,0-.53,0L4.61,12.84a.37.37,0,0,0,0,.53.35.35,0,0,0,.27.11.34.34,0,0,0,.26-.11l10.5-10.5A.37.37,0,0,0,15.64,2.34Z"></path>
	                                </g>
                                </g>
                            </svg>
                        </span>
                                <span class="modify-option" @click="deleteLink(link.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 59 59" style="enable-background:new 0 0 59 59;" xml:space="preserve" width="18px" height="18px">
                                <g>
                                    <path d="M29.5,51c0.552,0,1-0.447,1-1V17c0-0.553-0.448-1-1-1s-1,0.447-1,1v33C28.5,50.553,28.948,51,29.5,51z" fill="#363636"></path>
                                    <path d="M19.5,51c0.552,0,1-0.447,1-1V17c0-0.553-0.448-1-1-1s-1,0.447-1,1v33C18.5,50.553,18.948,51,19.5,51z" fill="#363636"></path>
                                    <path d="M39.5,51c0.552,0,1-0.447,1-1V17c0-0.553-0.448-1-1-1s-1,0.447-1,1v33C38.5,50.553,38.948,51,39.5,51z" fill="#363636"></path>
                                    <path d="M52.5,6H38.456c-0.11-1.25-0.495-3.358-1.813-4.711C35.809,0.434,34.751,0,33.499,0H23.5c-1.252,0-2.31,0.434-3.144,1.289   C19.038,2.642,18.653,4.75,18.543,6H6.5c-0.552,0-1,0.447-1,1s0.448,1,1,1h2.041l1.915,46.021C10.493,55.743,11.565,59,15.364,59   h28.272c3.799,0,4.871-3.257,4.907-4.958L50.459,8H52.5c0.552,0,1-0.447,1-1S53.052,6,52.5,6z M21.792,2.681   C22.24,2.223,22.799,2,23.5,2h9.999c0.701,0,1.26,0.223,1.708,0.681c0.805,0.823,1.128,2.271,1.24,3.319H20.553   C20.665,4.952,20.988,3.504,21.792,2.681z M46.544,53.979C46.538,54.288,46.4,57,43.636,57H15.364   c-2.734,0-2.898-2.717-2.909-3.042L10.542,8h37.915L46.544,53.979z" fill="#363636"></path>
                                </g>
                            </svg>

                    </span>
                            </div>
                        </div>


                    </div>


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
                previousPageUrl : '',
                descriptionAllowed: false,
                searchInput : '',
                showClearInput : false,
                hasError : false,
                errorMessage : '',
                editable : {},
                optionsVisible : {}
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

                    this.links.forEach((link) => {
                        Vue.set(this.editable, link.id, false);
                        Vue.set(this.optionsVisible, link.id, false);
                    });
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
                    this.descriptionAllowed = true;
                    this.hasError = false;
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
                    this.descriptionAllowed = false;
                })
                .catch(error => {
                    let errorMessage = JSON.parse(error.request.responseText);
                    if(errorMessage.error.includes('Url has already been stored:') ) {
                        this.errorMessage = 'Oops, looks like you already added that link. Try searching for it.'
                    }
                    else {
                        this.errorMessage = 'Oops, something went wrong. Make sure you have a link & description, refresh the page and try again.'
                    }
                    this.hasError = true;
                    console.log(JSON.parse(error.request.responseText));
                });
            },

            deleteLink(id) {
               let deleteConfirm = window.confirm("Are you sure you want to delete this link?");
               if(deleteConfirm === true) {
                   axios.delete('/api/links/' + id).then(response => {
                       this.links = response.data;
                   });
               }

            },

            updateLink(link) {
                axios.patch('/api/links/' + link.id, {description: link.description, url: link.url}).then(response => {
                    this.editable[link.id] = false;
                })
            },

            search(e) {
                let input = e.target.value;
                axios.get('/api/links/search?query=' + input).then(response => {
                    this.links = response.data;
                });
            },

            clearSearch() {
                let input = '';
                axios.get('/api/links/search?query=' + input).then(response => {
                    this.links = response.data;
                    this.searchInput = '';
                });
            },

            toggleOptionModual(id) {
                this.optionsVisible[id] = !this.optionsVisible[id];
            }

        }
    }
</script>
