<template>


    <div class="p-5">
        
        <FormComponent title="Ministry" :data="data" :columns="dataColumns" :options="dataOptions" @viewData="viewData" @deleteData="deleteData">
            <template slot="formHeader">
                <button class="btn btn-primary" v-on:click="createNew"><i class="fa fa-plus mr-2" aria-hidden="true"></i> Create New</button>
            </template>
        </FormComponent>


        <ModalComponent :title="modalTitle">
            <template slot="modalHeader">
                <button class="btn btn-link" v-if="isView" v-on:click="editData">Edit Data</button>
            </template>

            <template slot="modalBody">
                <label for="">Name</label>
                <input type="text" class="form-control" v-model="dataValues.name" :disabled="isDisabled">
                <div class="text-danger" v-if="errors.name">{{  errors.name[0] }}</div>
            </template>

            <template slot="modalFooter">
                <button class="btn btn-primary" v-if="!isView" v-on:click="storeData">Save Data</button>
            </template>
        </ModalComponent>

    </div>

</template>


<script>

import FormComponent from './Partials/FormComponent.vue';
import ModalComponent from './Partials/ModalComponent.vue';

export default {


    data() {

        return {

            errors : [],
            data : [],
            dataColumns : ['id','name','action'],
            dataOptions : {

                headings : {
                    id : '#',
                    name : 'Name',
                    action : '',
                },

                sortable : ['id','name'],
                filterable : ['id','name'],

            },


            dataValues : {
                name : '',
            },
            

            modalTitle : 'New Ministry',
            isView : false,
            isDisabled : true,


        }

    },

    components: {
        FormComponent,
        ModalComponent
    },

    methods: {

        getData() {

            axios.get('ministry/show').then(response => {
                
                this.data = response.data.data;

            });


        },


        createNew() {

            this.modalTitle = 'New Ministry';
            this.isView = false;
            this.isDisabled = false;
            this.dataValues = {
                name : '',
            },


            $('#modal-entry').modal('show');

        },


        storeData() {

            axios.post('ministry/store', this.dataValues).then(response => {

                this.$fire({ title: "Success", text: response.data.message, type: "success", timer: 3000 }).then(r => {

                    $('#modal-entry').modal('hide');
                    
                });

                this.getData();

            }).catch(errors => {

                this.errors = errors.response.data.errors;

            });

        },



        viewData(props) {

            console.log(props);

            this.isView = true;
            this.isDisabled = true;
            this.modalTitle = 'View Ministry';
            this.dataValues = {
                name : '',
            },


            axios.get('ministry/' + props.row.id).then(response => {

                this.dataValues = response.data.data;
                $('#modal-entry').modal('show');

            });


        },


        editData() {

            this.isDisabled = false;
            this.isView = false;

        },



        deleteData(props) {

            this.$confirm('Are you sure to Delete this Data?', 'Delete?', 'question').then(() => {

                axios.get('ministry/destroy/' + props.row.id).then(response => {
                
                        this.$fire({ title: "Success", text: response.data.message, type: "success", timer: 3000 });

                        this.getData();

                });

            });

        }




        
    },


    mounted() {
        
        this.getData();

    },



}

</script>

