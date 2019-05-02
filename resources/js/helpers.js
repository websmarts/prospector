export default {
    capitalizeFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    },
    formatDate(date){
        return date.slice(8,10) + "/" + date.slice(5,7) + "/" + date.slice(0,4);
    },
    displayStatus(statuscode){

        let status = '';

        switch (statuscode){
            case 0 : 
                status =  'closed';
                break;
            case 1: 
                status =  'open';
                break;

        }
        return status;

    }
}