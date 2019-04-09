import axios from 'axios';
import store from './store';

export default class {
  constructor() {

    let service = axios;
    let token = document.head.querySelector('meta[name="csrf-token"]');
    let api_token = document.head.querySelector('meta[name="api-token"]');

    this.store = store;
    

    service.interceptors.response.use(this.handleSuccess, this.handleError);
    service.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    service.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

    service.defaults.headers.common['Authorization'] = 'Bearer '+ api_token.content;

    service.interceptors.request.use(function(config) {
        store.startRequest();
        //alert('started loadind ...');
        return config;
    }, function(error) {
        store.endRequest();
        alert('OOPs an api request error occured')  

        return error;
    });
    this.service = service;
  }

  

 

  handleSuccess(response) {
      
    store.endRequest();
    
    return response;
  }

  handleError(error){
    
    store.endRequest();

    // console.log('handleError is handling this')

    switch (error.response.status) {
      case 401:
        
        // do something when you're unauthenticated
        alert('Not authenticated request')

        window.location.href = "/home";
        break;   
        
      case 403:
        // do something when you're unauthorized to access a resource
        alert('Not authorisded to access resource')
        break;

      case 500:
        // do something when your server exploded
        alert('Server returned 500 error, it may just be busy, close this alert to try again')
        //return axios.request(error.config);// re-issue request
        break;

      case 405:
        // alert('Method not allowed')
        break;

      case 422:
        // unprocessable entity - eg failed validation
        break;

      default:
        // handle normal errors with some alert or whatever
        alert('default error handler')
    }
    return Promise.reject(error)
  }

  redirectTo(document, path) {
    document.location = path
  }
  
  get(path, callback) {
    return this.service.get(path).then(
      (response) => callback(response.status, response.data)
    );
  }

  put(path, payload, callback) {   
        return this.service.request({
        method: 'PUT',
        url: path,
        responseType: 'json',
        data: payload
        }).then((response) => callback(response.status, response.data));
  }

  patch(path, payload, callback) {
    return this.service.request({
      method: 'PATCH',
      url: path,
      responseType: 'json',
      data: payload
    }).then((response) => callback(response.status, response.data));
  }

  post(path, payload, callback) {
    return this.service.request({
      method: 'POST',
      url: path,
      responseType: 'json',
      data: payload
    }).then((response) => callback(response.status, response.data));
  }
}