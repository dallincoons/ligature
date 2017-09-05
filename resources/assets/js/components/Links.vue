<template>
    <div class="container is-fluid">
        <section class="hero is-primary">
            <!--<a class="button is-dark is-large modal-button" data-target="modal">Add Link</a>-->
            <div class="hero-body">
                <div class="field">
                    <label class="label">Url</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Put something here" @keyup="getHeader()">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Description</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Put stuff here">
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        methods : {
            mounted(){
                axios.get('/api/links').then((response) => {
                    console.log(response);
                });
            },
            getHeader(){
                axios.get('/api/url-check').then((response) => {
                    console.log(response);
                });
            }
        }
    }
</script>
