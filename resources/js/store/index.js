import Vuex from 'vuex'
import Vue from 'vue'
Vue.use(Vuex)

import apiService from '../lib/apiServiceClass.js';
const api =  new apiService;


export default new Vuex.Store({
	strict: true,
	state: {
        today: new Date(),
		user:{},
		account:{},
		activities:[],
		campaigns:[],
		contacts:[],
		prospects:[],
		resources:[], // people assigned to work on campaigns
		loading: false,

		// User selected data
		campaign: {},
		prospect: {},
		prospectActivities: [],
		prospectContacts: [],
		// prospectCampaigns: []

		
	},
	mutations: {
		// Init the store with the auth user data
		// SET_APP_USER: function(state,user){
		// 	state.user = user
		// },
		
		INIT_APP_DATA: function(state,data) {
			//Object Updates
			state.user = Object.assign({}, data.user)
			state.account = Object.assign({}, data.account)

			// Array updates
			state.activities = data.activities
			state.campaigns = data.campaigns
			state.contacts = data.contacts
			state.prospects = data.prospects
			state.resources = data.resources

			state.campaign = data.campaigns[0]; // default to first campign

		},
		SELECT_CAMPAIGN: function(state,campaignId){
			state.campaign = _.find(state.campaigns,{id: campaignId})
			// And remove any selected prospect
			state.prospect = {}
			state.prospectActivities = {}
			state.prospectContacts = {}
			//state.prospectCampaigns = []

		},

		SELECT_PROSPECT: function(state,data){
			
			state.prospect = data.prospect
			state.prospectActivities = data.activities
			state.prospectContacts = data.contacts
			//state.prospectCampaigns = data.campaigns

			

		},

		UPDATE_PROSPECT: function(state,prospect){
			// Update prospect record in the prospects table
			var foundIndex = state.prospects.findIndex( (x) => {
				return x.id == state.prospect.id && x.campaign_id == state.prospect.campaign_id
			})

			// console.log('FoundIndex=',foundIndex)
			Vue.set(state.prospects,foundIndex, state.prospect)
		},

		UPDATE_CONTACT: function(state,contact){
			console.log('commiting contact update',contact)
			// replace the contact in the contacts array
			var foundIndex1 = state.contacts.findIndex( x =>  x.id == contact.id )
			console.log('index1',foundIndex1)
			Vue.set(state.contacts,foundIndex1, contact)

			// replace the contact in the prospectContacts array
			var foundIndex2 = state.prospectContacts.findIndex( x =>  x.id == contact.id )
			console.log('index2',foundIndex2)
			Vue.set(state.prospectContacts,foundIndex2, contact)

		},
		UPDATE_ACTIVITY: function(state,activity){
			console.log('commiting activity update',activity)

			// replace the activity in the activities array
			var foundIndex1 = state.activities.findIndex( x =>  x.id == activity.id )
			console.log('index1',foundIndex1)
			Vue.set(state.activities,foundIndex1, activity)

			// replace the activity in the prospectactivities array
			var foundIndex2 = state.prospectActivities.findIndex( x =>  x.id == activity.id )
			console.log('index2',foundIndex2)
			Vue.set(state.prospectActivities,foundIndex2, activity)

		},
		ADD_CONTACT: function(state,contact){
			console.log('commiting add contact ',contact)
			// add the contact in the contacts array
			state.contacts.push(contact)

			// add the contact in the prospectContacts array
			state.prospectContacts.push(contact)

		},
		ADD_ACTIVITY: function(state,activity){
			console.log('commiting add activity ',activity)
			// add the activity in the activities array
			state.activities.push(activity)



			// add the activity in the prospectactivities array
			state.prospectActivities.push(activity)

		}


		
	},
	getters: {
		today(state){
			return state.today
		},
		campaign(state){
			
			return state.campaign
		},
		campaignProspects(state){
			// Get prospects associated with the selected campaign
			
			return _.filter(state.prospects,{campaign_id:state.campaign.id})
		},
		campaignResources(state){
			return _.filter(state.resources,{campaign_id:state.campaign.id})
		},
		campaignActivities(state){
			return _.filter(state.activities,{campaign_id:state.campaign.id})
		},
		campaignActivitiesDue(state,getters){
			return _.filter(getters.campaignActivities, function(a){
				// console.log('Activity due',a.due)
				// console.log('Moment due',_moment(a.due))
				// console.log('Moment isAfter',_moment(a.due).isAfter())
				if(a.status > 0 && !_moment(a.due).isAfter(_moment(),'day')){
					return a
				}
			})
			// and the due date muct be today or less
		},
		prospect(state){
			if(state.prospect.hasOwnProperty("id")) {
				return state.prospect
				}		
				return false
		},
		prospectActivities(state,getters) {
			if(getters.prospect){
				// sort by due date
				// let prospectActivities = _.clone(state.prospectActivities)
				// return prospectActivities.sort(function compare(a, b) {
				// 	var dateA = new Date(a.due);
				// 	var dateB = new Date(b.due);
				// 	return dateA - dateB;
				//   });
				return state.prospectActivities
				
			}
			return []
			
		},
		prospectContacts(state,getters) {
			if(getters.prospect){
				return state.prospectContacts
			}
			return []
		},
		// prospectCampaign(state,getters) {
		// 	if(getters.prospect){
		// 		return _.find(state.prospectCampaigns,{campaign_id: state.campaign.id})
		// 	}
		// 	return {}
		// }
	
		
	},
	actions: {
		init(context) {
			
			api.get('/api/',(status,data) => {
                context.commit('INIT_APP_DATA', data.data)
			})
						
		},
		setAppUser(context,user){
			
			context.commit('SET_APP_USER',user)
		},
		selectCampaign(context,campaignId){
			context.commit('SELECT_CAMPAIGN',campaignId)
		},
		selectProspect({commit, state},prospectId){
			
			api.get('/api/prospect/' + prospectId +'?campaign=' +  state.campaign.id, (status,data) =>{
				commit('SELECT_PROSPECT',data.data)
			})
			
		},
		updateProspect({commit},prospect){
			api.patch('/api/prospect/'+ prospect.id + "?campaign="+prospect.campaign_id, prospect,(status,data) => {			
				commit('SELECT_PROSPECT',data.data)
				commit('UPDATE_PROSPECT',data.data.prospect)		
			})
		},
		saveProspectContact(context,contact){
			console.log('Save prospectContact',contact)
			api.post('/api/contact',contact,(status,data) =>{

				context.commit('ADD_CONTACT',data.data)
			})
		},
		updateProspectContact(context,contact){
			console.log('Update prospectContact',contact)
			api.patch('/api/contact/'+ contact.id, contact,(status,data) => {
					
				// dispatch('init')
				context.commit('UPDATE_CONTACT',data.data)
				
			})
		},
		saveProspectActivity(context,activity){
			console.log('Save prospectActivity',activity)
			api.post('/api/activity', activity,(status,data) => {
					
				
				context.commit('ADD_ACTIVITY',data.data)
				
			})
			
		},
		updateProspectActivity(context,activity){
			console.log('Update prospectActivity',activity)
			api.patch('/api/activity/'+ activity.id, activity,(status,data) => {
					
				
				context.commit('UPDATE_ACTIVITY',data.data)
				
			})
		}

	}
})