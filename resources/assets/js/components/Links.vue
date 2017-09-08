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
                        <input class="input" type="text" placeholder="Put stuff here" v-model="heading">
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                url : '',
                heading : '',
            }
        },
        created() {
            this.getHeader = _.debounce(this.getHeader, 750);
        },
        methods : {
            getHeader(){
                axios.post('/api/url-check', {
                    url : this.prepareUrl()
                }).then((response) => {
                    console.log(response);
                    this.heading = response.data.heading;
                });
            },
            prepareUrl(){
                if(! _.startsWith(this.url, 'http://') || _.startsWith(this.url, 'https://')){
                    this.url = 'http://' + this.url;
                }

                return this.url;
            }
        }
    }
</script>
