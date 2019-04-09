<template>
    <v-container grid-list-md align-center>
        <v-layout  row wrap>
            <v-flex xs12 md8>
                {{ user }}
                <card-finder></card-finder>
                
            </v-flex>
            <v-flex xs12 md4>
                <todo-list></todo-list>

            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>

export default {

    data() {
        return {
            
        }
    },
    computed: {
        user() {
            return this.$store.state.user
        }
    },
    mounted() {
        
    }
}

</script>