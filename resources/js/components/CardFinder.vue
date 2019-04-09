<template>
<v-card>
  <v-card-title>
    <span class="headline">Card finder</span>
    <v-spacer></v-spacer>
      <v-flex xs12>
        <v-text-field
            v-model="search"
            append-icon="search"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
      </v-flex>
      
      

      <v-flex xs6>
        <v-select
          :items="tags"
          v-model="show_tag"
          label="Tag"
        ></v-select>
      </v-flex>

      <v-flex xs6>
        <v-select
            :items="sections"
            v-model="show_section"
            label="Section"
          ></v-select>
      </v-flex>



  </v-card-title>
  <v-data-table
    :headers="headers"
    :items="listitems"
    :search="search"
    class="elevation-1"
  >
    <template v-slot:items="props">
      <tr @click="selectRow(props.item)">
      
      <td>{{ props.item.card_name }}</td>
      <td>{{ props.item.tag_name }}</td>
      <td>{{ props.item.contact_name   }}</td>
      <td>{{ props.item.section_name  }}</td>
      
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
        show_section:'',
        show_tag:'',
        sections:[
          {value:'',text:'Show all ...'},
          {value:'pet products', text:'Pet products'},
          {value:'promo products',text:'Promo products'}],
        tags: [
          {value:'',text:'Show all ...'},
          {value:'touched', text:'Touched'},
          {value:'not interested', text:'Not interested'},
          {value:'potential', text:'Potential'},
          {value:'converted', text:'Converted'},
          ],
        headers: [
          
          {
            text: 'Card name',
            align: 'left',
            value: 'card_name'
          },
          {
            text: 'Tag',
            align: 'left',
            value: 'tag_name'
          },
          {
            text: 'Contact',
            align: 'left',
            value: 'contact_name'
          },
          {
            text: 'Section',
            align: 'left',
            value: 'section_name'
          }

          
        ],
        
      }
    },
    computed: {
        listitems() {
          // reduce by section filter
          //console.log('SHOW SECTION LENGTH',this.show_section.length)

          let filteredItems = this.$store.state.cards

          if(this.show_section.length > 0){
            const sectionFilter = this.show_section
            
            filteredItems =  _.filter(filteredItems, o => {    
              return ! o.section_name.toLowerCase().indexOf(sectionFilter.toLowerCase()) 
            })
                
          } 

          if(this.show_tag.length > 0){
            const tagFilter = this.show_tag
            
            filteredItems =  _.filter(filteredItems, o => {    
              return ! o.tag_name.indexOf(tagFilter) 
            })
                
          } 

          return filteredItems
        }
    },
    methods: {
      
      
        selectRow(item){
          console.log('Row selected - item.id:',item.id)
        }
        
    },
    
  }
</script>