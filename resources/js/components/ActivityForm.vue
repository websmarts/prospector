<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="600px">
     
      <v-card>
        <v-card-title>
          <span class="headline">Activity</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 >
                <v-text-field v-model="formdata.activity" label="Activity*" required></v-text-field>
              </v-flex>

              <v-flex xs12>
                <v-select
                  v-model="formdata.contact_id"
                  :items="prospectContacts"
                  item-value="id"
                  item-text="name"
                  label="Contact*"
                  required
                ></v-select>
              </v-flex>
              
              <v-flex xs12>
                <v-select
                  v-model="formdata.status"
                  :items="[{value: 0, text: 'Closed'},{value:1,text:'Open'}]"
                  label="Status*"
                  required
                ></v-select>
              </v-flex>

              <v-flex xs12 >
                <v-date-picker v-model="formdata.due" ></v-date-picker>
              </v-flex>

              <v-flex xs12>
                <v-select
                  v-model="formdata.assigned_to"
                  :items="campaignResources"
                  item-text="name"
                  item-value="user_id"
                  label="Assign to"
                  
                ></v-select>
              </v-flex>

              

              <v-flex xs12 >
                <v-textarea
                  v-model="formdata.note"
                  label="Note"
        
                  hint="Add activity notes here"
                ></v-textarea>
              </v-flex>

              <v-flex xs12>
                <v-select
                  v-model="formdata.prospect_campaign_status"
                  :items="[{value: 1, text: 'Closed'},{value:0,text:'Open'}]"
                  label="Prospects campaign status*"
                  required
                ></v-select>
              </v-flex>
              
            </v-layout>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="close()">Close</v-btn>
          <v-btn :disabled="!tainted" color="success" @click="save()">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
  export default {
    props:{
      item: {type: Object, default: {}},
      dialog: Boolean
    },
    data: () => ({
      orgdata: {},
      formdata: {}
        
    }),
    computed: {
      tainted() {
            return !_.isEqual(this.formdata, this.orgdata)
      },
      prospect(){
            return this.$store.getters.prospect
      },
      prospectContacts(){
         return this.$store.getters.prospectContacts
      },
      campaignResources(){
            return this.$store.getters.campaignResources
      },
      
    },
    methods: {
      close() {
        this.$emit('close')
      },
      
      save(){
        //this.$emit('save',this.formdata)
        const data = Object.assign({},this.formdata)

        if(this.formdata.id > 0){
          this.$store.dispatch('updateProspectActivity',data)
        } else {
          // need to add campaign and prospect ids into activity data
          data.campaign_id = this.prospect.campaign_id
          data.prospect_id = this.prospect.id
          data.created_by = this.$store.state.user.id
          this.$store.dispatch('saveProspectActivity',data)
        }

        this.close()
       
      }
    },
    mounted() {

      const keys = [
        'id',
        'campaign_id',
        'prospect_id',
        //'parent_id',
        'contact_id',
        'activity',
        'note',
        'due',
        'status',
        'assigned_to',
        'created_by']

      let formdata = {}
      keys.forEach(key => formdata[key] = this.item.hasOwnProperty(key) ? this.item[key] : '' )
      this.formdata = Object.assign({},formdata)

      // make a copy of original data for taint testing
      this.orgdata = Object.assign({},this.formdata)
    }
  }
</script>