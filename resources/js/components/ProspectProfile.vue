<template>
    <v-card v-show="prospect">
        <v-card-title>
            <v-flex xs6 class="headline">Prospect details </v-flex>
        
            <v-flex xs6>
                <v-checkbox v-model="showform" label="Edit"></v-checkbox>
            </v-flex>
            <div v-html="profileAddress"></div>
      

        </v-card-title>

        <v-card-text>

            <v-form v-show="showform" v-model="valid">
        
            <div>
            <v-text-field
                v-model="formdata.name"
                label="Name"
                required
            ></v-text-field>
            </div>

            <div>
                    <v-text-field
                    v-model="formdata.phone"     
                    label="Phone"
                ></v-text-field>
                </div>
                <div>
                    <v-text-field
                    v-model="formdata.email"     
                    label="Email"
                ></v-text-field>
                </div>


                <div>
                    <v-text-field
                    v-model="formdata.address1"     
                    label="Address1"
                ></v-text-field>
                </div>
                <div>
                    <v-text-field
                    v-model="formdata.address12"     
                    label="Address2"
                ></v-text-field>
                </div>
                <div>
                    <v-text-field
                    v-model="formdata.address3"     
                    label="Address3"
                ></v-text-field>
                </div>
                <div>
                    <v-text-field
                    v-model="formdata.city"     
                    label="City"
                ></v-text-field>
                </div>
                <div>
                    <v-text-field
                    v-model="formdata.postcode"     
                    label="Postcode"
                ></v-text-field>
                </div>
                <div>
                    <v-select
                :items="states"
                :value="formdata.state"
                label="State"
                ></v-select>
                </div>
                <div>
                    <v-text-field
                    v-model="formdata.country"     
                    label="Country"
                ></v-text-field>
                </div>

                <div>
                    <v-text-field
                    v-model="formdata.notes"     
                    label="Notes"
                ></v-text-field>
                </div>

                <v-flex xs12 >
                <v-textarea
                  v-model="formdata.campaign_note"
                  label="Prospect campaign notes"
        
                  hint="Add prospect campaign notes here"
                ></v-textarea>
              </v-flex>

                <v-flex xs12>
                    <v-select
                    v-model="formdata.campaign_status"
                    :items="[{value: 0, text: 'Closed'},{value:1,text:'Open'}]"
                    label="Prospect campaign status*"
                    required
                    ></v-select>
                </v-flex>

                
                <v-btn
                    :disabled="!tainted || !valid "
                    color="success"
                    @click="save"
                
                    >
                    Save
                </v-btn>
            
        
            </v-form>
        </v-card-text>

    </v-card>
</template>

<script>
export default {
    data() {
        return {
            valid: false,
            showform: false,
            orgdata:{},
            formdata: {},
            states: ['VIC','NSW','NT','QLD','SA','TAS','WA'],

        }
    },
    computed:{
        
        prospect(){
            return this.$store.getters.prospect
        },
        prospectCampaign(){
            return this.$store.getters.prospectCampaign
        },
        tainted() {
            return !_.isEqual(this.formdata, this.orgdata)
        },
        profileAddress() {
            let detail =  "<p>"
            detail += _.get(this.orgdata,'phone') ?  this.orgdata.phone + "&nbsp; | &nbsp;" : ''
            detail += _.get(this.orgdata,'email') ?  this.orgdata.email : ''
            detail += "<br>"
            detail += _.get(this.orgdata,'address1') ?  this.orgdata.address1 : ''
            detail += _.get(this.orgdata,'address2') ? ", " + this.orgdata.address2 : ''
            detail += _.get(this.orgdata,'address3') ? ", " + this.orgdata.address3 : ''
            detail += _.get(this.orgdata,'city') ? ", " + this.orgdata.city : ''
             detail += _.get(this.orgdata,'state') ? ", " + this.orgdata.state : ''
            detail += _.get(this.orgdata,'postcode') ? ", " + this.orgdata.postcode : ''
            

            detail += "</p>"

            detail += _.get(this.orgdata,'prospect_campaign_note') ? "<p style='border-top: 1px solid #ccc'>Campaign note:<br>" + this.orgdata.prospect_campaign_note + "</p>" : ''

            return detail
        }

    },
    methods: {
        
        save() {
            this.$store.dispatch('updateProspect',this.formdata)
        }
    },
    watch: {
        prospect: function() {
            this.formdata = Object.assign({},this.prospect,this.prospectCampaign)
            this.orgdata = Object.assign({},this.prospect,this.prospectCampaign)
        }
    }
}
</script>