<template>
    
        <v-app id="inspire">
            <v-container >
                <v-layout align-center justify-center>
                    <router-view></router-view>
                </v-layout>
            </v-container>
        </v-app>
   
</template>


<script>

export default {
  
  data: function() {
    return {
      
    }
  },
  created: function() {
    
    //this.$store.commit('APP_USER', window.Laravel)
    this.$store.dispatch('init')
    
  }  
  
}
</script>

<style>

</style>