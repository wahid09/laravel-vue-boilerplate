<script setup>
import { ref, onMounted } from 'vue';
import { Form, Field, useResetForm } from 'vee-validate';
import * as yup from 'yup';

const divisions = ref([]);
const editing = ref(false);
const getDivision = () => {
    axios.get('/api/divisions')
        .then((response) => {
            divisions.value = response.data;
        })
}
const createDivisionSchema = yup.object({
    division_name: yup.string().required(),
    division_code: yup.string().required(),
    order: yup.string().required(),
});

const createUser = (values, { resetForm, setErrors }) => {
    axios.post('/api/divisions', values)
        .then((response) => {
            //users.value.data.unshift(response.data);
            $('#divisionModal').modal('hide');
            resetForm();
            //toastr.success('User created successfully!');
        })
        .catch((error) => {
            if (error.response.data.errors) {
                setErrors(error.response.data.errors);
            }
        })
};

const addDivision = () => {
    editing.value = false;
    $('#divisionModal').modal('show');
};
const handleSubmit = (values, actions) => {
    // console.log(actions);
    if (editing.value) {
        updateUser(values, actions);
    } else {
        createUser(values, actions);
    }
}

onMounted(() => {
    getDivision();
});
</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Division Management</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Division</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0 float-left">Division Management</h5>
                            <button @click="addDivision" type="button" class="btn btn-primary float-right"><i
                                    class="fa fa-plus-circle mr-1"></i> Add New
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="card-tools flex">
                                <p>Search Component</p>
                                <div class="row justify-content-left">
                                    <div class="btn-group btn-group-sm mr-1">
                                        <button type="button" class="btn btn-default">Action</button>
                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                    <div class="">
                                        <button type="button" class="btn btn-default">Action</button>
                                    </div>
                                </div>
                                <div>

                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            code
                                        </th>
                                        <th>address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="division in divisions" :key="division.id">
                                        <td>{{ division.id }}</td>
                                        <td>{{ division.division_name }}</td>
                                        <td>{{ division.division_code }}</td>
                                        <td>{{ division.division_address }}</td>
                                        <td>
                                            <a><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix">
                            <p>Perpage</p>
                            <div>
                                <p>Pagination</p>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- <div class="modal fade" id="divisionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Create Division</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form ref="form" autocomplete="off">
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Division Name *</label>
                                <input type="text" class="form-control"
                                    id="name" placeholder="Enter division name">
                                <span class="invalid-feedback" role="alert">
                                    <strong>message</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="name">Division Code</label>
                                <input type="text" class="form-control"
                                    id="name" placeholder="Division Code" >
                                <span class="invalid-feedback" role="alert">
                                    <strong>message</strong>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="name">Order</label>
                                <input type="number" class="form-control" id="name"
                                    placeholder="Enter Order">
                                <span class="invalid-feedback" role="alert">
                                    <strong>message</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="name">Division Address *</label>
                                
                            </div>


                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox"
                                        class="custom-control-input" id="is_active">
                                    <label class="custom-control-label" for="is_active">Status *</label>
                                </div>
                                <span class="invalid-feedback" role="alert">
                                    <strong>message</strong>
                                </span>
                            </div>

                            <div class="form-check">
                               
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-times mr-1"></i>Cancel
                        </button>
                        <button @click="CreateDivision" type="button" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    <div class="modal fade" id="divisionModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <span v-if="editing">Edit Division</span>
                        <span v-else>Add New Division</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form ref="form" @submit="handleSubmit"
                    :validation-schema="editing ? editDivisionSchema : createDivisionSchema" v-slot="{ errors }"
                    :initial-values="formValues">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Division Name</label>
                            <Field name="division_name" type="text" class="form-control"
                                :class="{ 'is-invalid': errors.division_name }" id="name" aria-describedby="nameHelp"
                                placeholder="Enter division name" />
                            <span class="invalid-feedback">{{ errors.division_name }}</span>
                        </div>

                        <div class="form-group">
                            <label for="code">Division Code</label>
                            <Field name="division_code" type="text" class="form-control "
                                :class="{ 'is-invalid': errors.division_code }" id="code" aria-describedby="nameHelp"
                                placeholder="Enter division code" />
                            <span class="invalid-feedback">{{ errors.division_code }}</span>
                        </div>
                        <div class="form-group">
                            <label for="order">Division Order</label>
                            <Field name="order" type="text" class="form-control " :class="{ 'is-invalid': errors.order }"
                                id="email" aria-describedby="nameHelp" placeholder="Enter division order" />
                            <span class="invalid-feedback">{{ errors.order }}</span>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <Field name="is_active" type="checkbox" class="custom-control-input"
                                    :class="{ 'is-invalid': errors.is_active }" id="is_active" aria-describedby="nameHelp"/>
                                <label class="custom-control-label" for="is_active">Status *</label>
                            </div>
                            <span class="invalid-feedback">{{ errors.is_active }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>