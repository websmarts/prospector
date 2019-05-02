<template>
    <v-card v-show="prospect">
        <v-card-title>
            <v-layout justify-space-between>
             <v-flex  xs7 class="headline">Activities </v-flex>
             <v-btn color="primary" dark @click="add()">Add Activity</v-btn>
            </v-layout>
        
        </v-card-title>

        <v-card-text>
            <activity-form v-if="dialog" :dialog="dialog" :item="activity" @save="save()" @close="closeForm()"></activity-form>
        </v-card-text>

        <v-data-table
            :headers="headers"
            :items="prospectActivities"
            class="elevation-1"
        >
            <template v-slot:items="props">
            <tr   :active="props.item.id == activity.id" @click="selectItem(props.item)">
            <td>{{ formatDate(props.item.due) }}</td>
            <td>
                <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                    <span v-on="on">{{ props.item.activity }}</span>
                </template>
                <span>{{props.item.note}}</span>
                </v-tooltip>
                
                
                
            </td>
            <td>{{ contactName(props.item.contact_id) }}</td>
            
            <td>{{ displayStatus(props.item.status) }}</td>
            <td>{{ resourceName(props.item.created_by) }}</td>
            <td>{{ resourceName(props.item.assigned_to) }}</td>
            
            
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
            
            activity: {},
            dialog: false,
            headers: [
                {
                text: 'Due date',
                align: 'left',
                value: 'due',
                sortable: true
            },
          
            {
                text: 'Activity',
                align: 'left',
                value: 'activity',
                sortable: false
            },
            {
                text: 'Contact',
                align: 'left',
                value: 'contact_id'
            },
            
            {
                text: 'Status',
                align: 'left',
                value: 'status'
            },
            {
                text: 'Created by',
                align: 'left',
                value: 'created_by'
            },
            {
                text: 'Assigned to',
                align: 'left',
                value: 'assigned_to'
            }
            

            
            ]
        }
    },
    methods: {
        selectItem(item){
          // console.log('Row selected - item.id:',item.id)
          this.activity = item
          this.showForm()
          // this.$store.dispatch('selectContact',item.id)
        },
        add() {
            this.activity = {}
            this.showForm()
        },
        showForm() {
            this.dialog = true;
        },
        closeForm() {
            this.activity = {}
            this.dialog = false

        },
        save() {
            this.closeForm()

        },
        resourceName(uid){
            if(uid) {
                let user = _.find(this.campaignResources,{user_id: uid})
                return (user && user.hasOwnProperty('name') ) ? user.name :'not set'
            }                    
        },
        contactName(cid){
            if(cid ){
                let contact = _.find(this.prospectContacts,{id: cid})
                return (contact && contact.hasOwnProperty('name') ) ? contact.name : 'not set'
            }
        },
        formatDate(date){
            return this.$helpers.formatDate(date)
        },
        displayStatus(statuscode){
            return this.$helpers.displayStatus(statuscode)
        }
    },
    computed: {
        prospect(){
            return this.$store.getters.prospect
        },

        prospectContacts() {
            return this.$store.getters.prospectContacts
        },
        
        prospectActivities(){
            return this.$store.getters.prospectActivities
        },

        campaignResources(){
            return this.$store.getters.campaignResources
        }

    }

}

</script>