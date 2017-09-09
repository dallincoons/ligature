<template>
    <div class="container is-fluid">
        <section class="hero is-primary">
            <!--<a class="button is-dark is-large modal-button" data-target="modal">Add Link</a>-->
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
                        <input class="input" type="text" placeholder="Put stuff here" v-model="description">
                    </div>
                </div>
                <a class="button is-white" @click="saveLink">Save</a>
            </div>
        </section>
        <div class="panel">
            <div class="panel-heading">
                links
            </div>
            <div class="panel-block is-active control has-icons-right" v-for="link in links">
                <a :href="link.url" target="_blank">{{link.description}}</a>
                <span @click="deleteLink(link.id)" style="pointer-events:auto;" class="icon is-large is-right is-clickable">X</span>
            </div>
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
            }
        },
        created() {

            axios.get('/api/links').then(response => {
                this.links = response.data;
            });

            this.getHeader = _.debounce(this.getHeader, 750);
        },
        methods : {
            getHeader() {
                axios.post('/api/url-check', {
                    url : this.url
                }).then((response) => {
                    console.log(response);
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
            }
        }
    }
</script>
