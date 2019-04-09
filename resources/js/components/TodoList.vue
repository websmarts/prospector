<template>
<v-card>
  <v-card-title>
    <span class="headline">ToDo list</span>
    <v-spacer></v-spacer>
    </v-card-title>
    <v-data-table
    :headers="headers"
    :items="listitems"
    :search="search"
    class="elevation-1"
  >
    <template v-slot:items="props">
      <tr @click="selectRow(props.item)">
      
      <td>{{ props.item.card.name }}</td>
      <td>{{ props.item.task }}</td>
      <td>{{ props.item.due }}</td>
      
      
      </tr> 
      
    </template>

    <v-alert v-slot:no-results :value="true" color="error" icon="warning">
        Your search for "{{ search }}" found no results.
      </v-alert>
  </v-data-table>

  </v-card>
</template>

<script>
  export default {
    data () {
      return {
        search: '',
       
        headers: [
          
          {
            text: 'Card',
            align: 'left',
            value: 'card.name'
          },
          {
            text: 'Task',
            align: 'left',
            value: 'task'
          },
          {
            text: 'Due',
            align: 'left',
            value: 'due'
          },
          

          
        ],
        
      }
    },
    computed: {
        listitems() {
          // reduce list by any filters
        

          return this.$store.state.todos
        }
    },
    
    methods: {
      
      
        selectRow(item){
          console.log('Row selected - item.id:',item.id)
        }
        
    },
    
  }
</script>