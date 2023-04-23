<template>


    <div class="p-5">
        
        <FormComponent title="Event" :data="data" :columns="dataColumns" :options="dataOptions" @viewData="viewData" @deleteData="deleteData">
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


                <label for="">Description</label>
                <input type="text" class="form-control" v-model="dataValues.description" :disabled="isDisabled">
                <div class="text-danger" v-if="errors.description">{{  errors.description[0] }}</div>


                <label for="">Church</label>
                <select class="form-control" v-model="dataValues.church_id" :disabled="isDisabled">
                    <option value="">--- ALL CHRUCHES ---</option>
                    <option v-for="item in churches" :value="item.id">{{  item.name  }}</option>
                </select>
                <div class="text-danger" v-if="errors.church_id">{{  errors.church_id[0] }}</div>


                <div class="form-check mt-3 mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" v-model="dataValues.is_regular_event" :disabled="isDisabled">
                    <label class="form-check-label" for="flexCheckDefault">
                        Is Regular Event?
                    </label>
                </div>


                <label for="">From</label>
                <input type="date" class="form-control" v-model="dataValues.from" :disabled="isDisabled">
                <div class="text-danger" v-if="errors.from">{{  errors.from[0] }}</div>

                
                <label for="">To</label>
                <input type="date" class="form-control" v-model="dataValues.to" :disabled="isDisabled">
                <div class="text-danger" v-if="errors.to">{{  errors.to[0] }}</div>

                    
                <label for="">Start Time</label>
                <input type="time" class="form-control" v-model="dataValues.start_time" :disabled="isDisabled">
                <div class="text-danger" v-if="errors.start_time">{{  errors.start_time[0] }}</div>


                <label for="">End Time</label>
                <input type="time" class="form-control" v-model="dataValues.end_time" :disabled="isDisabled">
                <div class="text-danger" v-if="errors.end_time">{{  errors.end_time[0] }}</div>


                <div v-if="dataValues.is_regular_event">
                    <label for="">Day</label>
                    <select class="form-control" v-model="dataValues.day" :disabled="isDisabled">
                        <option v-for="item in days" :value="item">{{  item  }}</option>
                    </select>
                    <div class="text-danger" v-if="errors.day">{{  errors.day[0] }}</div>
                </div>
                
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
        churches : Array,
    },


    data() {

        return {

            errors : [],
            data : [],
            dataColumns : ['event_id', 'name','description','from','to','start_time','end_time','church','day','action'],
            dataOptions : {

                headings : {
                    event_id : '#',
                    name : 'Name',
                    description : 'Description',
                    from : 'From',
                    to : 'To',
                    start_time : 'Start Time',
                    end_time : 'End Time',
                    church : 'Church',
                    day : 'Day',
                    action : '',
                },

                sortable : ['id','name'],
                filterable : ['id','name'],

            },

            days : [
                'MONDAY',
                'TUESDAY',
                'WEDNESDAY',
                'THRUSDAY',
                'FRIDAY',
                'SATURDAY',
                'SUNDAY',
            ],


            dataValues : {
                name : '',
                description : '',
                from : '',
                to : '',
                start_time : '',
                end_time : '',
                church_id : null,
                day : '',
                is_regular_event : false,
            },

            

            modalTitle : 'New Event',
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

            axios.get('event/show').then(response => {
                this.data = response.data.data;
            });


        },


        initData(action) {

            this.isView = action;
            this.isDisabled = action;
            this.dataValues = {
                name : '',
                description : '',
                from : '',
                to : '',
                start_time : '',
                end_time : '',
                church_id : null,
                day : '',
                is_regular_event : false,
            };

        },


        createNew() {
            
            this.modalTitle = 'New Event';
            this.initData(false);
            $('#modal-entry').modal('show');

        },


        storeData() {

            axios.post('event/store', this.dataValues).then(response => {

                this.$fire({ title: "Success", text: response.data.message, type: "success", timer: 3000 }).then(r => {
                    $('#modal-entry').modal('hide');
                });

                this.getData();

            }).catch(errors => {

                this.errors = errors.response.data.errors;

            });

        },



        viewData(props) {

            this.modalTitle = 'View Event';
            this.initData(true);


            axios.get('event/' + props.row.id).then(response => {
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

                axios.get('event/destroy/' + props.row.id).then(response => {
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

