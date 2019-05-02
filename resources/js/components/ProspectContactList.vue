<template>
    <v-card v-show="prospect">
        <v-card-title>
            <v-layout justify-space-between >
                <v-flex class="headline">Contacts</v-flex>
                
                <v-flex class="text-xs-right"><v-btn color="primary" dark @click="add()">Add Contact</v-btn></v-flex>
            </v-layout>
      
             

        </v-card-title>
        <v-card-text>
            <contact-form v-if="dialog" :dialog="dialog" :item="contact" @save="save()" @close="closeForm()"></contact-form>
        </v-card-text>

        <v-data-table
            :headers="headers"
            :items="contacts"
            class="elevation-1"
        >
            <template v-slot:items="props">
            <tr  :active="props.item.id == contact.id " @click="selectItem(props.item)">
            
            <td>{{ props.item.name }}</td>
            <td>{{ props.item.email }}</td>
            <td>{{ props.item.phone }}</td>
            <td>{{ props.item.mobile }}</td>
            
            
            </tr> 
            
            </template>

            <v-alert v-slot:no-results :value="true" color="error" icon="warning">
                 no results found to display.
            </v-alert>
        </v-data-table>

        
    </v-card>
</template>

<script>

export default {
    data() {
        return {
            contact: {},
            dialog: false,
            headers: [
          
            {
                text: 'Name',
                align: 'left',
                value: 'activity'
            },
            {
                text: 'Email',
                align: 'left',
                value: 'email'
            },
            {
                text: 'Phone',
                align: 'left',
                value: 'phone'
            },
            {
                text: 'Mobile',
                align: 'left',
                value: 'mobile'
            }
            

            
            ]
        }
    },
    methods: {
        selectItem(item){
          // console.log('Row selected - item.id:',item.id)
          this.contact = item
          this.showForm()
          // this.$store.dispatch('selectContact',item.id)
        },
        add() {
            this.contact = {}
            this.showForm()
        },
        showForm() {
            this.dialog = true;
        },
        closeForm() {
            this.contact = {}
            this.dialog = false

        },
        save() {
            this.closeForm()

        }
    },
    computed: {
        
        prospect(){
            return this.$store.getters.prospect
        },
        contacts(){
            return this.$store.getters.prospectContacts
        }
    }

}
</script>
