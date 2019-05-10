<template>
    <v-container grid-list-md align-center>
        <v-layout row wrap >
            <v-toolbar>
                <v-toolbar-side-icon></v-toolbar-side-icon>
                <v-toolbar-title>Prospector</v-toolbar-title>
                <v-spacer></v-spacer>
                    {{ user.name }}
                <v-spacer></v-spacer>
                <v-toolbar-items class="hidden-sm-and-down">
                <v-btn @click="logout" flat>Logout</v-btn>
            
                </v-toolbar-items>
            </v-toolbar>
            

            <v-flex xs12 md4 >
                <campaign-selector></campaign-selector>
                <div style="padding:2px"></div>
                <prospect-list></prospect-list>

            </v-flex>  

            <v-flex xs12 md8>
                <prospect-activity-list></prospect-activity-list>
                <div style="padding:2px"></div>
                <prospect-contact-list></prospect-contact-list>
                <div style="padding:2px"></div>
                <prospect-profile></prospect-profile>
                
                
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
    methods: {
        logout() {
            window.location.href='/logout'
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