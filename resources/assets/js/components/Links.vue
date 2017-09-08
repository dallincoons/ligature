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
    </div>
</template>

<script>
    export default {
        data(){
            return {
                url         : '',
                description : '',
            }
        },
        created() {
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
                });
            },
        }
    }
</script>
