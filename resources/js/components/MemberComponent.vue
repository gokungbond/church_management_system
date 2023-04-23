<template>


    <div class="p-5">
        
        <FormComponent title="Member" :data="data" :columns="dataColumns" :options="dataOptions" @viewData="viewData" @deleteData="deleteData">
            <template slot="formHeader">
                <button class="btn btn-primary" v-on:click="createNew"><i class="fa fa-plus mr-2" aria-hidden="true"></i> Create New</button>
            </template>
        </FormComponent>


        <ModalComponent :title="modalTitle">
            <template slot="modalHeader">
                <button class="btn btn-link" v-if="isView" v-on:click="editData">Edit Data</button>
            </template>

            <template slot="modalBody">
                <label for="">Last name</label>
                <input type="text" class="form-control" v-model="dataValues.last_name" :disabled="isDisabled">
                <div class="text-danger" v-if="errors.last_name">{{  errors.last_name[0] }}</div>

                <label for="">First Name</label>
                <input type="text" class="form-control" v-model="dataValues.first_name" :disabled="isDisabled">
                <div class="text-danger" v-if="errors.first_name">{{  errors.first_name[0] }}</div>

                <label for="">Middle Name</label>
                <input type="text" class="form-control" v-model="dataValues.middle_name" :disabled="isDisabled">
                <div class="text-danger" v-if="errors.middle_name">{{  errors.middle_name[0] }}</div>

                <label for="">Date of Birth</label>
                <input type="date" class="form-control" v-model="dataValues.dob" :disabled="isDisabled">
                <div class="text-danger" v-if="errors.dob">{{  errors.dob[0] }}</div>

                <label for="">Address</label>
                <textarea class="form-control" v-model="dataValues.address" :disabled="isDisabled"></textarea>
                <div class="text-danger" v-if="errors.address">{{  errors.address[0] }}</div>

                <label for="">Family</label>
                <select class="form-control" v-model="dataValues.family_id" :disabled="isDisabled">
                    <option value=""></option>
                    <option v-for="item in families" :value="item.id">{{  item.name  }}</option>
                </select>
                <div class="text-danger" v-if="errors.family_id">{{  errors.family_id[0] }}</div>

                <label for="">Church</label>
                <select class="form-control" v-model="dataValues.church_id" :disabled="isDisabled">
                    <option v-for="item in churches" :value="item.id">{{  item.name  }}</option>
                </select>
                <div class="text-danger" v-if="errors.church_id">{{  errors.church_id[0] }}</div>

                <label for="">Member Category</label>
                <select class="form-control" v-model="dataValues.member_category" :disabled="isDisabled">
                    <option value="CHILDREN">CHILDREN</option>
                    <option value="YOUNG">YOUNG</option>
                    <option value="YOUNG PRO">YOUNG PRO</option>
                    <option value="ELDER">EDLER</option>
                </select>
                <div class="text-danger" v-if="errors.member_category">{{  errors.member_category[0] }}</div>

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

    props : {
        families : Array,
        churches : Array,
        ministries : Array,
    },

    data() {

        return {


            errors : [],
            data : [],
            dataColumns : ['member_id','full_name','dob','address', 'family', 'church', 'member_category','action'],
            dataOptions : {

                headings : {
                    id : '#',
                    full_name : 'Name',
                    dob : 'Date of Birth',
                    address : 'Address',
                    family : 'Family',
                    church : 'Church',
                    action : 'Action',
                },

                sortable : ['id','full_name','dob','address', 'family', 'church', 'member_category'],
                filterable : ['id','full_name','dob','address', 'family', 'church', 'member_category'],

            },


            dataValues : {
                last_name : '',
                first_name : '',
                middle_name : '',
                dob : '',
                address : '',
                family_id : '',
                church_id : '',
                member_category : '',
            },

            

            modalTitle : 'New Member',
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

            axios.get('member/show').then(response => {
                
                this.data = response.data.data;

            });


        },


        createNew() {

            this.modalTitle = 'New Member';
            this.isView = false;
            this.isDisabled = false;
            this.dataValues = {
                name : '',
                address : '',
            },


            $('#modal-entry').modal('show');

        },


        storeData() {

            axios.post('member/store', this.dataValues).then(response => {

                this.$fire({ title: "Success", text: response.data.message, type: "success", timer: 3000 }).then(r => {

                    $('#modal-entry').modal('hide');
                    
                });

                this.getData();

            }).catch(errors => {

                this.errors = errors.response.data.errors;

            });

        },



        viewData(props) {

            this.isView = true;
            this.isDisabled = true;
            this.modalTitle = 'View Member';
            this.dataValues = {
                'name' : '',
            },


            axios.get('member/' + props.row.id).then(response => {

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

                axios.get('member/destroy/' + props.row.id).then(response => {
                
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

