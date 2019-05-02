<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="600px">
     
      <v-card>
        <v-card-title>
          <span class="headline">Contact details</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              
              <v-flex xs12 >
                <v-text-field v-model="formdata.name" label="Name*" required></v-text-field>
              </v-flex>

              <v-flex xs12 >
                <v-text-field v-model="formdata.phone" label="Phone" ></v-text-field>
              </v-flex>

              <v-flex xs12 >
                <v-text-field v-model="formdata.mobile" label="Mobile*" ></v-text-field>
              </v-flex>
              
              <v-flex xs12>
                <v-text-field v-model="formdata.email" label="Email" ></v-text-field>
              </v-flex>

              <v-flex xs12 >
                <v-textarea
                  v-model="formdata.note"
                  label="Note"
        
                  hint="Add notes about contact here"
                ></v-textarea>
              </v-flex>
              
              
              
            </v-layout>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="close()">Close</v-btn>
          <v-btn :disabled="!tainted" color="success"  @click="save()">Save</v-btn>
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
      orgdata:{},
      formdata: {}
    }),
    computed: {
      tainted() {
            return !_.isEqual(this.formdata, this.orgdata)
        },
        prospect(){
            return this.$store.getters.prospect
      },
    },
    methods: {
      close() {
        this.$emit('close')
      },
      save(){
        
        const data = Object.assign({},this.formdata)

        if(this.formdata.id > 0){
          this.$store.dispatch('updateProspectContact',data)
        } else {
          // add the prospect_id to the new record
          data.prospect_id = this.prospect.id
          this.$store.dispatch('saveProspectContact',data)
        }

        this.close()
       
      }
    },
    mounted() {

       const keys = [
        'id',
        'prospect_id',
        'name',
        'phone',
        'mobile',
        'email',
        'note'
        ]
      let formdata ={}
      keys.forEach(key => formdata[key] = this.item.hasOwnProperty(key) ? this.item[key] : '' )

      this.formdata = Object.assign({},formdata)
    
      // make a copy of original data for taint testing
      this.orgdata = Object.assign({},formdata)
      
    }
  }
</script>