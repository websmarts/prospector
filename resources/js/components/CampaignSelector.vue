<template>
    <v-card>
        <v-card-title>
            <span class="headline">Campaign selector</span>
       
        <v-select 
        label="Select campaign"
        
        @input="selectCampaign"
        :value="campaignId"
        :items="campaignOptions" 
        item-text="name"
        item-value="id"
       >
        </v-select>
</v-card-title>
        


    </v-card>
</template>

<script>

export default {
    data () {
        return {
            campaign_id: false
            
        }
    },
    computed: {
        campaignOptions() {
            return this.$store.state.campaigns
        },
        campaignId() {
            return this.$store.getters.campaign.id
        }
    },
    methods: {
        selectCampaign(campaign) {
            this.$store.dispatch('selectCampaign',campaign)
        }
    }
}

</script>
