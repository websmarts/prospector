<template>
<v-card>
  <v-card-title>
    <span class="headline">Campaign prospects ({{ listitems.length }})</span>
    <v-spacer></v-spacer>
    
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
    :headers="headers"
    :items="listitems"
    
    class="elevation-1"
  >
    <template v-slot:items="props">
      <tr  :active="props.item.id == prospect.id" @click="selectRow(props.item)">
      
      <td>{{ props.item.name }}</td>
      <td>{{ props.item.status }}</td>
      <td @click.stop="selectTask(props.item)">{{ props.item.activity_count }}</td>
      
      
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
        itemcount: 0,
        selected: null,
       
        headers: [
          
          {
            text: 'Prospect',
            align: 'left',
            value: 'id'
          },
          {
            text: 'Status',
            align: 'left',
            value: 'status'
          },
          {
            text: 'Tasks due',
            align: 'left',
            value: 'activity_count'
          },
          

          
        ],
        
      }
    },
    computed: {
        listitems() {
          // reduce list by any filters
          let items = [];
          let prospects = this.$store.getters.campaignProspects
          let campaignActivitiesDue = this.$store.getters.campaignActivitiesDue

          let search = this.search

          _.each(_.filter(prospects, function(prospect){
            if(prospect.name.toLowerCase().includes(search.toLowerCase())){
              return prospect
            }
          }), function(prospect){
              var counter = _.filter(campaignActivitiesDue, function(o) { 
                if (o.prospect_id == prospect.id) {
                
                  return o 
                }
                
                
                }).length;

      
              items.push({
                id: prospect.id,
                name: prospect.name, 
                status: '', 
                activity_count: counter
              })
          })
          
          return items
        },

    
       
        prospect(){
          return this.$store.getters.prospect
            
        },
        campaign() {
          return this.$store.getters.campaign
        }


    
    },
    
    methods: {
      
        
        selectRow(item){
          // console.log('Row selected - item.id:',item.id)
          this.$store.dispatch('selectProspect',item.id)
        },
        selectTask(item){
          // First select the prospect who own the task
          this.selectRow(item)


          //console.log('Task Row selected - item.id:',item.id)
        }

        
    },
    mounted() {
      
    }
    
  }
</script>