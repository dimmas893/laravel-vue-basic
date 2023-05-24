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
                <button type="submit" @click="savestudent">save</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'studentCreate',
    data() {
        return {
            errorlist: '',
            model: {
                student: {
                    name: '',
                    email: ''
                }
            }
        }
    },
    methods: {
        savestudent() {
            var inithis = this;
            axios.post('http://localhost:8000/api/user/post', this.model.student).then(res => {
                console.log(res)
                alert(res.data.message)
                this.model.student = {
                    name: '',
                    email: ''
                },
                    this.errorlist = '';
            })
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status === 422) {
                            inithis.errorlist = error.response.data.errors;
                            console.log(inithis.errorlist)
                        }
                        if (error.response.status === 404) {
                                    alert(error.response.data.message)
                            console.log(inithis.errorlist)
                        }
                    }
                })
        }
    }
}
</script>