<template>
    <div class="container is-fluid">
        <section class="hero is-primary">
            <!--<a class="button is-dark is-large modal-button" data-target="modal">Add Link</a>-->
            <div class="hero-body">
                <div class="field">
                    <label class="label">Url</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Put something here" @blur="getHeader()" v-model="url">
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
        methods : {
            getHeader(){
                axios.post('/api/url-check', {
                    url : this.url
                }).then((response) => {
                    this.heading = response.data.heading;
                });
            }
        }
    }
</script>
