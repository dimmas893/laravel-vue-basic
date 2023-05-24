<template>
    <div class="card">
        <div class="card-header">
            <h4>students</h4>
            <RouterLink class="nav-link" to="/students/create">Add Student</RouterLink>
        </div>
        <div class="card-body">
            <table class="table" v-if="this.students.length > 0">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>email</th>
                        <th>created at</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(student, index) in this.students" :key="index">
                        <td> {{ student.id }}</td>
                        <td> {{ student.name }}</td>
                        <td> {{ student.email }}</td>
                        <td> {{ student.created_at }}</td>
                        <td>
                            <RouterLink class="btn btn-info" :to="{ path: '/students/' + student.id + '/edit' }">edit
                            </RouterLink>
                            <button type="button" @click="TombolDelete(student.id)" class="btn btn-danger">delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            
                <table v-else>
                    <div class="container">
                        <div class="auto-load text-center">
                            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60" viewBox="0 0 100 100"
                                enable-background="new 0 0 0 0" xml:space="preserve">
                                <path fill="#000"
                                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                        from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                </path>
                            </svg>
                        </div>
                    </div>
                </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'students',
    data() {
        return {
            students: [],
            studentsid: ''
        }
    },
    mounted() {
        this.getStudents();
        // console.log('haha')
    },
    methods: {
        getStudents() {
            axios.get('http://localhost:8000/api/user').then(res => {
                this.students = res.data.data;
                // console.log(this.students)
            });
        },
        TombolDelete(studentsid) {
            axios.delete(`http://localhost:8000/api/user/${studentsid}/delete`).then(res => {
                alert(res.data.message)
                this.getStudents();
            })
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status === 404) {
                            inithis.errorlist = error.response.data.message;
                        }
                    }
                })
        }
    }
}
</script>