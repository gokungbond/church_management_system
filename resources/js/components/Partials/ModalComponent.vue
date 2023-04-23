<template>
    <div class="modal" id="modal-entry">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <h5>{{  title }}</h5>
                        <slot name="modalHeader"></slot>
                    </div>
                </div>
                <div class="modal-body">
                    <slot name="modalBody"></slot>    
                </div>
                <div class="modal-footer text-right">
                    <slot name="modalFooter"></slot>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {

    props: {
        title : String,
    },


    data() {

        return {
            isView: false,
        }

    },

    methods: {
        
        editData() {

        },

        storeData() {

        },

    },
    
}
</script>