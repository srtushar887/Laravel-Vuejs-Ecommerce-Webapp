export default {
    data(){
        return{

        }
    },
    methods:{
        async callApi(method,url,dataobj ){
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: dataobj
                });
            }catch (e) {
                return e.response
            }
        },
    }
}
