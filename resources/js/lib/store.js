export default {
    debug: true,
    state: {
      requestCounter: 0
    },
    startRequest () {
      
      this.state.requestCounter++;
    },
    endRequest () {
     
      this.state.requestCounter = this.state.requestCounter-- < 0 ? this.state.requestCounter : 0   ;
      
    },
    isActive () {
    
        return this.state.requestCounter > 0;
    },
    


  }