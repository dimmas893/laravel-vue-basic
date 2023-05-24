<template>
    <ul class="alert alert-warning" v-if="Object.keys(this.errorlist).length > 0">
           <li v-for="(error, index) in this.errorlist" :key="index">
            {{ error[0] }}
        </li>
    </ul>
    <div class="card">
        <div class="card-header">
            add
        </div>
        <div class="card-body">
            <div>
                <input type="text" placeholder="name" v-model="model.student.name" name="name">
                <input type="email" placeholder="email" v-model="model.student.email" name="email">
                <button type="submit" @click="updatedata">update</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'studentsedit',
    data() {
        return {
            studenId:'',
            errorlist: '',
            model: {
                student: {
                    name: '',
                    email: ''
                }
            }
        }
    },
    mounted() {
        // console.log(this.$route.params.id);
        this.studenId = this.$route.params.id
        this.getparamaterid(this.studenId)
    },
    methods: {
        getparamaterid(studenId) {
            var inithis = this;
            axios.get(`http://localhost:8000/api/user/${studenId}/edit`).then(res => { 
                // console.log(res)
                this.model.student = res.data.data;
            })
             .catch(function (error) {
                    if (error.response) {
                        if (error.response.status === 404) {
                            inithis.errorlist = error.response.data.message;
                            console.log(inithis.errorlist)
                        }
                    }
                })
            
        },
        updatedata() {
            var inithis = this;
            axios.put(`http://localhost:8000/api/user/${this.studenId}/update`, this.model.student).then(res => {
                // console.log(res)
                alert(res.data.message)
                    this.errorlist = '';
            })
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status === 422) {
                            inithis.errorlist = error.response.data.errors;
                            console.log(inithis.errorlist)
                        }
                    } else if (error.request) {
                        console.log(error.request)
                    } else {
                        console.log('Error', error.message)
                    }
                })
        }
    }
}
</script>