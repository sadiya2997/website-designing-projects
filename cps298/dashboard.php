<?php
date_default_timezone_set('America/Detroit');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Smart Watering Plant System</title>
	<h1>BrawndoBros</h1>
<h2>Smart Watering Plant System</h2>
<p class="link"><a href="login.php">Logout</a></p>

    <!-- font awesome registered kit, dont reuse !!! -->
    <script src="https://kit.fontawesome.com/4eae736292.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        body {
            min-height: 75rem;
            padding-top: 4.5rem;
        }

        .footer {
            background-color: #f5f5f5;
        }

        .footer>.container {
            padding-right: 15px;
            padding-left: 15px;
        }

        .nowrap {
            display: inline-block;
            white-space: nowrap;
        }
    </style>

</head>

<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<body>

    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">
                <i class="fas fa-frog"></i>
                <i class="fas fa-cloud-sun-rain"></i>
                watering
                <i class="fas fa-tint"></i>
            </a>

            <div id="app-busy" class="col-xs-2">
                <!--div class="spinner-border spinner-border-sm text-light" role="status">
      <span class="sr-only">Loading...</span>
    </div-->
                <div v-if="busy" class="spinner-grow spinner-grow-sm text-light" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <!--
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
      -->
                </ul>

                <!--form class="form-inline mt-2 mt-md-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form-->
            </div>
        </nav>
    </header>

    <main role="main" class="container">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="true">Plant Status</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="schedule" aria-selected="false">Schedule</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="program-tab" data-toggle="tab" href="#program" role="tab" aria-controls="program" aria-selected="false">Program</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="valves-tab" data-toggle="tab" href="#valves" role="tab" aria-controls="valves" aria-selected="false">Direct Control</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="system-tab" data-toggle="tab" href="#system" role="tab" aria-controls="system" aria-selected="false">System</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="license-tab" data-toggle="tab" href="#license" role="tab" aria-controls="license" aria-selected="false">License</a>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <a class="nav-link" id="license-tab" role="tab" aria-controls="license" aria-selected="false">
	-->
                    <span id="app-statusbar">
                        <span v-on:click="show_all">
                            Notifications
                            <i class="far fa-bell"></i>
                            <span class="badge " v-bind:class="{ 'badge-light': !has_error, 'badge-danger' : has_error, }" v-if="unread_msg>0">
                                {{ msg_hint }}
                            </span>
                        </span>
                        <span v-if="unread_msg>0" v-on:click="clear">
                            <i class="fas fa-trash"></i>
                        </span>

                        <span id="app-status-view" class="modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
									<p class="link"><a href="plant.php">plant</a></p>
                                        <h5 class="modal-title">Current</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">Text</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(v,ii) in messages">
                                                    <td>{{ v.h | digit2_format }}:{{ v.m | digit2_format }}:{{ v.s | digit2_format }}</td>
                                                    <td>{{ v.text }}</td>
                                                    <td>{{ v.type_ }}</td>
                                                    <td>{{ v.status }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
									<p class="link"><a href="logout.php">Logout</a></p>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </span>

                    </span>

                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="status" role="tabpanel" aria-labelledby="status-tab">

                <div id="app-status">

                    <button class="btn btn-primary" v-on:click="reload">
                        <i class="fas fa-sync"></i>
                        reload status</button>

                    <button v-if="!scheduler_pause" class="btn btn-primary" v-on:click="stop">
                        <i class="fas fa-pause"></i>
                    </button>

                    <button v-if="scheduler_pause" class="btn btn-danger" v-on:click="play">
                        <i class="fas fa-play"></i>
                    </button>

                    <button class="btn" v-bind:class="{ 'btn-primary' :auto_refresh, 'btn-outline-primary' : !auto_refresh, }" v-on:click="toggle_refresh()">
                        <div v-if="auto_refresh"><i class="fas fa-sync"></i> Auto-Reload On</div>
                        <div v-if="!auto_refresh"><i class="fas fa-sync"></i> Auto-Reload Off</div>
                    </button>

                    <span v-if="last_refresh">Last Update: {{ last_refresh | time_format }} </span>
                    <span v-if="auto_refresh">Next Update: {{ next_refresh }} </span>
                    <span v-if="cur_time">Time: {{ cur_time | time_format }}</span>

                    <span>Fan: {{flow.current}} Liter: {{flow.current_liter}} </span>
                    <button class="btn btn-primary" v-on:click="reload_flow">
                        <i class="fas fa-sync"></i>
                        reload flow</button>

						<button class="btn btn-primary" v-on:click="image">
                        
                        Plant Image</button>

                    <div>&nbsp;</div>
                    <h5>Current:</h5>

                    <div class="table" v-if="valves.length==0">{{ 'Empty' | 'loading_format }}</div>

                    <div class="table-responsive-xl" v-if="valves.length>0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th v-for="(v,ii) in valves" scope="col">{{ v.name || ('Port: ' + ii) }}</th>
                                    <th>Action:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td v-for="(v,ii) in valves" scope="col">
                                        <div>
                                            {{ v.result | onoff_format }}
                                            <i v-if="v.result" class="fas fa-tint"></i>
                                            <i v-if="!v.result" class="fas fa-tint-slash"></i>
                                        </div>

                                        <div>
                                            {{ remaining_time(ii) }} sec
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn" :disabled="kill_disabled()" v-on:click="kill_current()">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>&nbsp;</div>
                    <h5>Next:</h5>
                    <div class="table" v-if="tasks.length==0">{{ 'Empty' | loading_format }}</div>

                    <div class="table-responsive-xl" v-if="tasks.length>0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th v-for="(v,ii) in valves" scope="col">{{ v.name || ('Port: ' + ii) }}</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(task,ti) in tasks">
                                    <td>{{ti}}</td>
                                    <td v-for="(el,eli) in task" scope="col">
                                        {{tasks[ti][eli]}}
                                    </td>
                                    <td>
                                        <button class="btn" v-on:click="remove_task(ti)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h5>Scheduled:</h5>
                    <div class="table" v-if="curscheduled.length==0">{{ 'Empty' | loading_format }}</div>

                    <div class="table-responsive-xl" v-if="curscheduled.length>0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Program</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">End</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(sched,i) in curscheduled">
                                    <td>{{sched.id}}</td>
                                    <td>{{sched.name}}</td>
                                    <td>{{ prog_caption( sched.program ) }}</td>
                                    <td>{{sched.time}}</td>
                                    <td>{{ end_time( sched ) }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <div class="tab-pane" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">

                <div id="app-scheduled">

                    <button class="btn btn-primary" v-on:click="reload">
                        <i class="fas fa-sync"></i>
                        reload schedule</button>
                    <button class="btn btn-primary" v-on:click="add">
                        <i class="fas fa-plus"></i>
                        add new </button>
                    <button class="btn btn-primary" v-on:click="save">
                        <i class="fas fa-save"></i>
                        save </button>

                    <div class="table-responsive-xl">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Program</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">End</th>
                                    <th scope="col">Weekday</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(sched,i) in scheduled">
                                    <td>{{sched.id}}</td>
                                    <td><input class="form-control" v-model="sched.name"></td>
                                    <td>
                                        <select class="form-control" v-model="sched.program">
                                            <option v-for="(prog,pi) in programs" :value="prog.id">{{ prog_caption( prog.id ) }}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input :id="'sched_time_'+sched.id" type="time" class="form-control" v-model="sched.time">
                                    </td>
                                    <td>
                                        {{ end_time( sched ) }}
                                    </td>
                                    <td>
                                        <span v-for="(d,di) in sched.dow" class="nowrap">
                                            <label class="form-check-label" for="'schedule_weekday_'+i">{{ weekdays[di].substr(0,2) }}</label>
                                            <input class="form-check form-check-inline align-middle" type="checkbox" @change="reset_all_chk(sched.id)" v-model="sched.dow[di]" :id="'schedule_weekday_'+i">
                                        </span>
                                        <span class="nowrap">
                                            <label class="form-check-label" for="'schedule_allweekday_'+i">all</label>
                                            <input class="form-check form-check-inline align-middle" type="checkbox" v-model="alldays[sched.id]" @change="toggle_days(i,sched.id)" :id="'schedule_allweekday_'+i">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="nowrap" v-bind:class="{ 'btn-warning': !sched.active }">
                                            <label class="form-check-label" for="'sched_active_'+i">Active</label>
                                            <input class="form-check form-check-inline align-middle" type="checkbox" v-model="sched.active" :id="'sched_active_'+i">
                                        </span>

                                        <button class="btn" v-on:click="remove(i)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <div class="tab-pane" id="program" role="tabpanel" aria-labelledby="program-tab">
                <div id="app-programs">

                    <button class="btn btn-primary" v-on:click="reload">
                        <i class="fas fa-sync"></i>
                        reload programs</button>
                    <button class="btn btn-primary" v-on:click="add">
                        <i class="fas fa-plus"></i>
                        add new program</button>
                    <button class="btn btn-primary" v-on:click="save">
                        <i class="fas fa-save"></i>
                        save programs</button>

                    <div class="accordion" id="accordion_programs">

                        <div class="card" v-for="(prog,i) in programs">
                            <div class="card-header" :id="'head_program_'+prog.id">
                                <div class="mb-0">
                                    <div class="input-group mb-3">

                                        <button class="btn" v-on:click="play(i)">
                                            <i class="fas fa-play"></i>
                                        </button>
                                        <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="'#body_program_'+prog.id" aria-expanded="true" :aria-controls="'body_program_'+prog.id">
                                            Program #{{prog.id}}
                                        </button>
                                        <input class="form-control" v-model="prog.name">
                                        <div>&nbsp;</div>
                                        <div class="form-check form-check-inline" v-bind:class="{ 'btn-warning': !prog.active }">
                                            <label class="form-check-label" for="'prog_chk_'+prog.id">Active:</label>
                                            <div>&nbsp;</div>
                                            <input class="form-check-input" type="checkbox" v-model="prog.active" :id="'prog_chk_'+prog.id">
                                        </div>
                                        <button class="btn" v-on:click="remove(i)">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>

                            <div :id="'body_program_'+prog.id" class="collapse show" :aria-labelledby="'head_program_'+prog.id" data-parent="#accordion_programs">
                                <div class="card-body">

                                    <button class="btn btn-primary" v-on:click="add_task(i)">
                                        <i class="fas fa-plus"></i>
                                        add new task</button>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th v-for="(v,ii) in valves_cfg" scope="col">{{ v.name || ('Port: ' + ii) }}</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(task,ti) in prog.tasks">
                                                <td>{{ti+1}}</td>
                                                <td v-for="(el,eli) in task" scope="col">
                                                    <input class="form-control" v-model.number="prog.tasks[ti][eli]">
                                                </td>
                                                <td>
                                                    <button class="btn" :disabled="ti==prog.tasks.length-1" v-on:click="move_task(prog,ti,1)">
                                                        <i class="fas fa-arrow-down"></i>
                                                    </button>
                                                    <button class="btn" :disabled="ti==0" v-on:click="move_task(prog,ti,-1)">
                                                        <i class="fas fa-arrow-up"></i>
                                                    </button>
                                                    <button class="btn" v-on:click="remove_task(prog,ti)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="tab-pane" id="valves" role="tabpanel" aria-labelledby="valves-tab">

                <div id="app-valves">

                    <button class="btn btn-primary" v-on:click="reload">
                        <i class="fas fa-sync"></i>
                        reload</button>

                    <span></span>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Port</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(v,i) in valves">
                                <td>{{ i+1 }}</td>
                                <td>{{ v.name }}</td>
                                <td>
                                    <!--input class="form-check-input "
                      type="checkbox"
                      :disabled="v.disabled" :id="'valve_cntrl_'+i"
                      v-model="v.result" @change="on_change(i)"-->

                                    <button class="btn" v-bind:class="{ 'btn-primary' :v.result, 'btn-outline-primary' : !v.result, }" v-on:click="click(i)">
                                        <div v-if="v.result"><i class="fas fa-tint"></i> {{ v.result | onoff_format }}</div>
                                        <div v-if="!v.result"><i class="fas fa-tint-slash"></i> {{ v.result | onoff_format }}</div>
                                    </button>

                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

            <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                <div id="app-settings">

                    <button class="btn btn-primary" v-on:click="reload_config">
                        <i class="fas fa-sync"></i>
                        reload settings</button>

                    <button class="btn btn-primary" v-on:click="save">
                        <i class="fas fa-save"></i>
                        save settings</button>

                    <button class="btn btn-primary" v-on:click="add_port">
                        <i class="fas fa-plus"></i>
                        add new port</button>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Port</th>
                                <th scope="col">Pin</th>
                                <th scope="col">Name</th>
                                <th scope="col">Disabled</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(v,i) in valves_cfg">
                                <td>{{ i+1 }}</td>
                                <td><input class="form-control" v-model.number="v.pin" :id="'valve_pin_'+i"></td>
                                <td><input class="form-control" type="text" v-model="v.name" :id="'valve_name_'+i"></td>
                                <td><input class="align-middle" type="checkbox" v-model="v.disabled" :id="'valve_disabled_'+i"></td>
                                <td>
                                    <button class="btn" :disabled="i==valves_cfg.length-1" v-on:click="move(i,1)">
                                        <i class="fas fa-arrow-down"></i>
                                    </button>
                                    <button class="btn" :disabled="i==0" v-on:click="move(i,-1)">
                                        <i class="fas fa-arrow-up"></i>
                                    </button>
                                    <button class="btn" v-on:click="remove(i)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div>Timezone offset [seconds]:</div>
                    <div class="input-group mb-3">
                        <input class="form" v-model.number="timezone_offset">
                        <button class="btn btn-primary" v-on:click="save_tz">
                            <i class="fas fa-save"></i>
                            save</button>

                    </div>

                    <div>Auto restart device:</div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" v-model="restart.active" aria-label="Active: Auto-restart">
                            </div>
                        </div>
                        <input type="time" v-model="restart.time" class="form" aria-label="Auto-restart time">
                        <button class="btn btn-primary" v-on:click="save_restart">
                            <i class="fas fa-save"></i>
                            save</button>
                    </div>

                    <div v-if="flow">
                        <div>Flow:</div>
                        <div class="input-group mb-3">

                            <label for="flow_pin">Pin:</label>
                            <input class="form-control" id="flow_pin" v-model.number="flow.pin">

                            <label for="flow_max">Max:</label>
                            <input class="form-control" id="flow_max" v-model.number="flow.max">

                            <label for="flow_ratio">Ratio:</label>
                            <input class="form-control" id="flow_ratio" v-model.number="flow.liter_ratio">

                            <button class="btn btn-primary" v-on:click="save_flow">
                                <i class="fas fa-save"></i>
                                save</button>

                        </div>
                    </div>


                </div>

            </div>

            <div class="tab-pane" id="system" role="tabpanel" aria-labelledby="system-tab">

                <div id="app-system">

                    <button class="btn btn-primary" v-on:click="reload">
                        <i class="fas fa-sync"></i>
                        reload</button>

                    <button class="btn btn-primary" v-on:click="gc">
                        <i class="fas fa-broom"></i>
                        run garbage collection</button>

                    <button class="btn btn-danger" v-on:click="restart_hard">
                        <i class="fas fa-bolt"></i>
                        restart device</button>

                    <button class="btn btn-danger" v-on:click="restart_soft">
                        <i class="fas fa-bolt"></i>
                        restart modcore</button>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Key</th>
                                <th scope="col">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="k in Object.keys(info).sort()">
                                <td>{{ k }}</td>
                                <td>{{ JSON.stringify(info[k]) }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

            <!-- <div class="tab-pane" id="license" role="tabpanel" aria-labelledby="license-tab">

                <div id="app-license">

                    <div>&nbsp;</div>
                    <div>Included Software Components. Following free, and non-free Licenses apply. </div>
                    <div>&nbsp;</div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Component</th>
                                <th scope="col">Homepage</th>
                                <th scope="col">License</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="lic in licenses">
                                <td>{{ lic.name }}</td>
                                <td><a :href="lic.home" target="_blank">
                                        {{ lic.home }} <i class="fas fa-external-link-alt"></i></a></td>
                                <td><a :href="lic.info" target="_blank">
                                        {{ lic.type }} <i class="fas fa-external-link-alt"></i></a></td>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        This list might be incomplete.
                        Refer to the individual references for additional License information.
                    </div>
                    <div>&nbsp;</div>
                    <div>
                        License-File:
                        <div v-if="license_file.length==0">Not found <i class="fas fa-info-circle "></i>
                            <div>
                                Please buy a License if you want to use this Product.
                            </div>
                        </div>
                        <div v-if="license_file.length>0">{{ license_file }} valid until: {{ license_valid }}.
                            <div>
                                Thanks for purchasing and supporting this Product.
                            </div>
                        </div>
                    </div>
                    <div>

                    </div>

                </div>

            </div>

        </div>
	-->


        <div id="app-confirm" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ head }}</h5>
                        <button type="button" class="close" data-dismiss="modal" v-on:click="on_cancel_hndl" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ body }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" v-on:click="on_cancel_hndl" data-dismiss="modal">{{ cancel }}</button>
                        <button type="button" class="btn btn-primary" v-on:click="on_ok_hndl">
                            {{ ok }}</button>
                    </div>
                </div>
            </div>
        </div>


    </main>


     <!--<footer id="app-footer" class="footer mt-auto py-3">
        <div class="container">
            <span class="text-muted">
                &copy; 2020-{{ year }} K. Goger
                - <a href="https://github.com/kr-g" target="_blank">
                    <i class="fas fa-user"></i>
                    https://github.com/kr-g
                </a>
                - <a href="https://github.com/kr-g/mpymodcore_watering" target="_blank">
                    <i class="fas fa-home"></i>
                    https://github.com/kr-g/mpymodcore_watering
                </a>
            </span>
        </div>
    </footer>
	-->
</body>

<script>
    async function post(url = '', data = {}) {
        //url = urlmock(url)
        console.log("post", url, data);
        app_busy.enter();
        // Default options are marked with *
        try {
            const response = await fetch(url, {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                    'Content-Type': 'application/json'
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: 'error', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify(data), // body data type must match "Content-Type" header
            });
            console.log("post done", url, data);
            app_statusbar.add("post " + url, "info", "ok")
            return response;
        } catch (ex) {
            console.log("post failed", url, data, ex)
            app_statusbar.add("post " + url, "error", "failed")
            return;
        } finally {
            app_busy.leave()
        }
    }

    // mock fetch backend
    cache_url_results = {
        '/watering/valves/config': '[{ "disabled" : false, "pin" : 13, "name" : "Port 1"}, { "disabled" : false, "pin" : 27, "name" : "Port 2"}, { "disabled" : false, "pin" : 26, "name" : "Port 3"}, { "disabled" : false, "pin" : 25, "name" : "Port 4"}, { "disabled" : false, "pin" : 33, "name" : "Port 5"}, { "disabled" : false, "pin" : 32, "name" : "Port 6"}]',
        '/watering/programs': '[{"id": 1591554060492, "active": true, "name": "eins", "tasks": [[1, 0, 2, 0, 3, 0], [0, 1, 0, 2, 0, 3]]}, {"id": 1591554113373, "active": true, "name": "zwei", "tasks": [[0, 0, 0, 0, 0, 1]]}]',
        '/watering/valves': '[{"error": false, "name": "Port 1", "pin": 13, "result": false, "state": false, "disabled": false, "pause": false}, {"error": false, "name": "Port 2", "pin": 27, "result": false, "state": false, "disabled": false, "pause": false}, {"error": false, "name": "Port 3", "pin": 26, "result": false, "state": false, "disabled": false, "pause": false}, {"error": false, "name": "Port 4", "pin": 25, "result": false, "state": false, "disabled": false, "pause": false}, {"error": false, "name": "Port 5", "pin": 33, "result": false, "state": false, "disabled": false, "pause": false}, {"error": false, "name": "Port 6", "pin": 32, "result": false, "state": false, "disabled": false, "pause": false}]',
        '/system/timezone': '{"timezone_offset": 7200}',
        '/system/info': '{"modcore": "v0.0.10a", "time": 644945701, "localtime": [2020, 6, 8, 15, 35, 1, 0, 160], "unique_id": "3c71bff014a4", "mem_alloc": 2456256, "app": "v0.0.1a", "timezone_offset": 7200, "localtime_tz": [2020, 6, 8, 17, 35, 1, 0, 160], "localtime_offset": 7200, "mem_free": 1641984, "freq": 160000000, "softap": {"active": false, "mac": "3c71bff014a5", "ip": ["192.168.4.1", "255.255.255.0", "192.168.4.1", "0.0.0.0"]}, "wlan": {"active": true, "mac": "3c71bff014a4", "ip": ["192.168.178.26", "255.255.255.0", "192.168.178.1", "192.168.178.1"]}}',
        '/watering/scheduled': '[ { "id": 123, "time": "23:00", "dow": [ 0, 1, 0, 0, 0, 0, 0 ], "name": "", "active": true, "program": 1591554060492 } ]',
    }

    function mock_fetch(url) {
        console.log("mockfetch", url);
        resp = new Promise(function(resolve) {
            json = function() {
                return new Promise(function(json_resolve) {
                    data = cache_url_results[url];
                    jsond = JSON.parse(data);
                    json_resolve(jsond);
                })
            };
            resolve({
                json: json,
                status: 200
            });
        });
        return resp;
    }
    // end of - mock fetch backend


    async function get(url) {
        console.log("get", url);
        app_busy.enter();
        var response
        try {
            response = await fetch(url, {
                method: 'GET', // *GET, POST, PUT, DELETE, etc.
                mode: 'no-cors', // no-cors, *cors, same-origin
                redirect: 'error', // manual, *follow, error
            })
        } catch (ex) {
            console.log(ex);
            app_statusbar.add("get " + url + " " + ex, "error", "failed")
            throw ex;
        } finally {
            app_busy.leave()
        }
        console.log("get done", url, response.status);
        try {
            jsn = await response.json()
            app_statusbar.add("get " + url, "info", "ok")
            return jsn
        } catch (ex) {
            console.log(response, ex);
            app_statusbar.add("get " + url + " " + ex, "error", "failed")
            throw ex;
        }
    }


    Vue.filter('time_format', function(value) {
        if (!value) return '';
        return value.toLocaleTimeString();
    })
    Vue.filter('onoff_format', function(value) {
        if (value == undefined) return '';
        return value ? "On" : "Off";
    })
    Vue.filter('loading_format', function(value) {
        if (state_loading) return 'Loading...';
        return value;
    })
    Vue.filter('digit2_format', function(value) {
        v = value.toString()
        if (v.length < 2) v = "0" + v;
        return v;
    })


    var app_footer = new Vue({
        el: '#app-footer',
        data: {
            year: new Date().getFullYear(),
        },
        methods: {},
    });


    var app_busy = new Vue({
        el: '#app-busy',
        data: {
            refcount: 0,
            busy: false,
        },
        methods: {
            enter: function() {
                ++this.refcount;
                this.busy = true;
            },
            leave: function() {
                if (this.refcount > 0) {
                    --this.refcount;
                }
                this.busy = this.refcount > 0;
            },
        },
    });

    class MsgInfo {
        constructor(text, type_, status) {
            var d = new Date()
            this.h = d.getHours()
            this.m = d.getMinutes()
            this.s = d.getSeconds()
            this.text = text
            this.type_ = type_
            this.status = status
            this.unread = true
        }
    }

    var app_statusbar = new Vue({
        el: '#app-statusbar',
        data: {
            messages: [],
            msg_hint: 0,
            unread_msg: 0,
            error_msg: 0,
            has_error: false,
            max_items: 100,
        },
        methods: {
            add: function(text, type_, status) {
                this.messages.splice(0, 0, new MsgInfo(text, type_, status))
                if (this.messages.length >= this.max_items) this.pop()
                this.update_state()
            },
            pop: function() {
                this.messages.pop()
                this.update_state()
            },
            update_state: function() {
                reducer = (acc, val) => val.unread ? acc + 1 : acc
                this.unread_msg = this.messages.reduce(reducer, 0)

                reducer_err = (acc, val) => (val.type_ == "error") ? acc + 1 : acc
                this.error_msg = this.messages.reduce(reducer_err, 0)

                this.has_error = this.messages.some((e) => e.type_ == "error")

                this.msg_hint = this.unread_msg
                if (this.has_error) {
                    this.msg_hint += " / " + this.error_msg
                }
            },
            mark: function(no) {
                this.messages[no].unread = false
                this.update_state()
            },
            clear: function() {
                this.messages = []
                this.update_state()
            },
            show_all: function() {
                console.log("show_all")
                if (this.messages.length == 0) return
                $('#app-status-view').modal('show')
            },
        },
    });

    var app_confirm = new Vue({
        el: '#app-confirm',
        data: {
            head: "text",
            body: "text",
            cancel: "text",
            ok: "text",
            on_cancel: function() {},
            on_ok: function() {},
        },
        methods: {
            show: function(opts) {
                if (opts == undefined) {
                    opts = {};
                }
                this.head = opts.head || "Confirm";
                this.body = opts.body || "are you sure?";
                this.cancel = opts.cancel || "Cancel";
                this.ok = opts.ok || "Ok";
                this.on_cancel = opts.on_cancel || function() {
                    console.log("cancel pressed");
                };
                this.on_ok = opts.on_ok || function() {
                    console.log("ok pressed");
                };
                $('#app-confirm').modal('show');
            },
            hide: function() {
                $('#app-confirm').modal('hide');
            },
            on_ok_hndl: function() {
                this.hide();
                this.on_ok();
            },
            on_cancel_hndl: function() {
                this.on_cancel();
            },
        },
    })

    function confirm(head, body, cb) {
        app_confirm.show({
            head: head || "Confirm",
            body: body,
            on_ok: cb,
        });
    };

    function confirm_delete(body, cb) {
        app_confirm.show({
            head: "Delete?",
            body: body,
            on_ok: cb,
        });
    };

    // simple state management

    function pushobj(name, obj, cb) {
        apps = [app_status, app_scheduled, app_programs, app_valves, app_settings, app_system, ];
        found = 0;
        objstr = JSON.stringify(obj);
        apps.forEach(app => {
            if (name in app) {
                app[name] = JSON.parse(objstr); // deep clone
                app[name + '_org'] = JSON.parse(objstr); // deep clone
                found++;
            }
        });
        console.log("pushobj", name, found);
        cb && cb();
    }

    class state {

        constructor(obj, name) {
            console.log(name, obj);
            this.obj_name = name;
            this.obj = obj;
            this.val = null;
        }

        begin() {
            this.org = JSON.parse(JSON.stringify(this.obj[this.obj_name]));
        }

        commit() {
            if (this.org == null) {
                console.log("no begin called before");
                return
            }
            pushobj(this.obj_name, this.obj[this.obj_name]);
            this.org = null
        }

        rollback() {
            if (this.org == null) {
                console.log("no begin called before");
                return
            }
            this.obj[this.obj_name] = JSON.parse(JSON.stringify(this.org));
            this.org = null
        }
    }

    // 

    function get_valves(cb) {
        get("/watering/valves").then(obj => {
            pushobj("valves", obj);
            cb && cb();
        });
    }

    function get_valves_config(cb) {
        get("/watering/valves/config").then(obj => {
            pushobj("valves_cfg", obj);
            cb && cb();
        });
    }

    function get_programs(cb) {
        get("/watering/programs").then(obj => {
            pushobj("programs", obj);
            cb && cb();
        });
    }

    function get_scheduled(cb) {
        get("/watering/scheduled").then(obj => {
            pushobj("scheduled", obj);
            cb && cb();
        });
    }

    function get_scheduled_recalc(cb) {
        post("/watering/scheduled/recalc").then(x => get_scheduled(cb));
    }

    function get_flow(cb) {
        get("/watering/flow").then(obj => {
            pushobj("flow", obj.flow);
            cb && cb();
        });
    }

    function get_system_info(cb) {
        get("/system/info").then(obj => {
            pushobj("info", obj);
            cb && cb();
        });
    }

    function get_reboot_config(cb) {
        get("/system/reboot/config").then(obj => {
            pushobj("restart", obj.reboot);
            cb && cb();
        });
    }

    function get_system_timezone(cb) {
        get("/system/timezone").then(obj => {
            pushobj("timezone_offset", obj.timezone_offset);
            cb && cb();
        });
    }

    function get_state(cb) {
        app_status.reload_state(cb);
    }

    //

    var app_status = new Vue({
        el: '#app-status',
        data: {
            auto_refresh: true,
            last_refresh: null,
            next_refresh: null,
            cur_time: new Date(),
            scheduler_pause: false,
            flow: {
                current: 0,
                current_liter: 0,
            },

            valves: [],
            programs: [],
            states: {},

            kill_disabled() {
                return this.current.filter(x => x > 0).length == 0
            },

            current: [],
            curtasks: [],
            tasks: [],
            curscheduled: [],

            state: true,
        },
        methods: {
            remaining_time: function(pos) {
                //console.log("remaining_time", pos, this.curtasks );
                if (pos >= this.curtasks.length) {
                    return 0;
                }
                return Math.max(this.curtasks[pos].diff, 0);
            },
            reload_state: function(cb) {
                get("/watering/state").then(obj => {
                    this.states = obj;
                    this.current = obj.current;
                    this.curtasks = obj.curtasks;
                    this.tasks = obj.next;
                    this.curscheduled = obj.scheduled;
                    this.scheduler_pause = obj.scheduler_pause;
                    this.flow_fan = obj.flow_fan;
                    this.flow_liter = obj.flow_liter;

                    cb && cb();
                });
                this.last_refresh = new Date();
            },
            reload_flow: function() {
                get_flow();
            },
            reload: function() {
                get_valves(x => get_programs(x => get_state(x => get_flow())));
            },
            stop: function() {
                this.state = false;
                get("/watering/pause/true").then(x => get_state());
            },
            play: function() {
                this.state = true;
                get("/watering/pause/false").then(x => get_state());
            },
            toggle_refresh: function() {
                this.auto_refresh = !this.auto_refresh;
            },
            remove_task_el: function(pos) {
                console.log("remove_task_el", pos);
                this.tasks.splice(pos, 1);
                post("/watering/state/remove/" + pos).then(x => get_state());
            },
            remove_task: function(pos) {
                console.log("remove_task", pos);
                confirm_delete("Task: " + pos, function() {
                    app_status.remove_task_el(pos);
                });
            },
            kill_current: function() {
                console.log("kill_current");
                post("/watering/state/kill").then(x => get_state());
            },
            prog_caption: function(id) {
                progs = this.programs.filter(p => p.id == id);
                if (progs.length == 0)
                    return "ERROR";
                prog = progs[0];
                cap = prog.name.trim();
                if (cap.length == 0) {
                    cap = prog.id;
                }
                return cap;
            },
            end_time: function(sched) {
                progs = this.programs.filter(p => p.id == sched.program);
                if (progs.length == 0)
                    return "ERROR";
                prog = progs[0];

                sum_max_task = (acc, val) => acc + Math.max(...val);
                total = prog.tasks.reduce(sum_max_task, 0);

                endt = new Date();

                t = sched.time.split(":");
                endt.setSeconds(0);
                endt.setMinutes(t[1]);
                endt.setHours(t[0]);

                ut = endt.getTime();
                ut += total * 1000;
                endt.setTime(ut);

                const options = {
                    hour: '2-digit',
                    minute: '2-digit'
                };
                const format = new Intl.DateTimeFormat("us-us", options).format;

                return format(endt);
            },

        },
    });

    function auto_cur_time() {
        app_status.cur_time = new Date();
        app_status.next_refresh--;
        setTimeout(auto_cur_time, 1000);
    }

    function auto_refesh() {
        if (app_status.auto_refresh) {
            if (active_tab[0] == "status-tab")
                app_status.reload();
            else
                console.log("status tab not active, skip auto_refesh");
        }
        app_status.next_refresh = 30
        setTimeout(auto_refesh, app_status.next_refresh * 1000);
    }


    var weekdays = new Array(7);
    weekdays[0] = "Sunday";
    weekdays[1] = "Monday";
    weekdays[2] = "Tuesday";
    weekdays[3] = "Wednesday";
    weekdays[4] = "Thursday";
    weekdays[5] = "Friday";
    weekdays[6] = "Saturday";

    var app_scheduled = new Vue({
        el: '#app-scheduled',
        data: {
            programs: [],
            scheduled: [],
            weekdays: weekdays,
            alldays: {},
        },
        methods: {
            reload: function() {
                get_programs(x => get_scheduled());
            },
            save: function() {
                post("/watering/scheduled", this.scheduled).then(x => get_scheduled_recalc(x => get_state()));
            },
            add: function() {
                now = Date.now();
                d = new Date(now);
                sched = {
                    id: now,
                    time: "23:00",
                    dow: [0, 0, 0, 0, 0, 0, 0],
                    name: "",
                    active: true,
                    program: "",
                };
                sched.dow[d.getDay()] = true;
                sched.time = d.getHours() + ":" + d.getMinutes();
                this.scheduled.push(sched);
            },
            remove_schedule: function(pos) {
                console.log("remove_schedule", pos);
                this.scheduled.splice(pos, 1);
            },
            remove: function(pos) {
                console.log("remove", pos);
                sched = this.scheduled[pos];
                id = sched.id;
                name = sched.name;
                confirm_delete("Schedule: " + id, function() {
                    app_scheduled.remove_schedule(pos);
                });
            },
            prog_caption: function(id) {
                // todo refactor
                progs = this.programs.filter(p => p.id == id);
                if (progs.length == 0)
                    return "ERROR";
                prog = progs[0];
                cap = prog.name.trim();
                if (cap.length == 0) {
                    cap = prog.id;
                }
                return cap;
            },
            end_time: function(sched) {
                // todo refactor
                progs = this.programs.filter(p => p.id == sched.program);
                if (progs.length == 0)
                    return "ERROR";
                prog = progs[0];

                sum_max_task = (acc, val) => acc + Math.max(...val);
                total = prog.tasks.reduce(sum_max_task, 0);

                endt = new Date();

                t = sched.time.split(":");
                endt.setSeconds(0);
                endt.setMinutes(t[1]);
                endt.setHours(t[0]);

                ut = endt.getTime();
                ut += total * 1000;
                endt.setTime(ut);

                const options = {
                    hour: '2-digit',
                    minute: '2-digit'
                };
                const format = new Intl.DateTimeFormat("us-us", options).format;

                return format(endt);
            },

            toggle_days: function(pos, id) {
                console.log("toggle_days", pos, id);
                state = this.alldays[id];
                this.scheduled[pos].dow.fill(state);
            },
            reset_all_chk: function(id) {
                console.log("reset_all_chk", id)
                this.alldays[id] = false;
            }
        },
    });

    var app_programs = new Vue({
        el: '#app-programs',
        data: {
            valves_cfg: [],
            programs: [],
            scheduled: [],
        },
        methods: {
            reload: function() {
                get_valves_config(x => get_programs(x => get_scheduled()));
            },
            save_programs: function() {
                return post("/watering/programs", this.programs)
            },
            save: function() {
                this.save_programs().then(x => pushobj("programs", this.programs, x => get_scheduled(x => get_state())));
            },
            create_task: function() {
                newobj = []
                for (i in this.valves_cfg) {
                    newobj.push(0);
                }
                return newobj;
            },
            add: function() {
                this.programs.push({
                    id: Date.now(),
                    name: "",
                    active: true,
                    tasks: [this.create_task(), ],
                });
            },
            remove_program: function(pos) {
                console.log("remove_program", pos);
                this.programs.splice(pos, 1);
            },
            remove: function(pos) {
                console.log("remove", pos);
                prog = this.programs[pos];
                id = prog.id;
                name = prog.name;

                ids = []
                for (i in this.scheduled) {
                    ids.push(this.scheduled[i].program);
                }

                used = ids.find(x => x == id);
                console.log("remove", id, used, ids);

                if (used) {
                    confirm("Notification", "Object is in use");
                    return
                }

                confirm_delete("Program: " + id, function() {
                    app_programs.remove_program(pos);
                });
            },
            play: function(pos) {
                console.log("play", pos);
                confirm("Start?", "Program: " + this.programs[pos].id, function() {
                    post("/watering/program/play/" + pos).then(x => get_state());
                });

            },
            add_task: function(prog_pos) {
                prog = this.programs[prog_pos];
                prog.tasks.push(this.create_task());
            },
            move_task: function(prog, pos, d) {
                t = prog.tasks[pos];
                prog.tasks.splice(pos, 1);
                prog.tasks.splice(pos + d, 0, t);
            },
            remove_task_elm: function(prog, task_pos) {
                prog.tasks.splice(task_pos, 1)
                console.log("remove task", task_pos);
            },
            remove_task: function(prog, task_pos) {
                confirm_delete("Task: " + task_pos, function() {
                    app_programs.remove_task_elm(prog, task_pos);
                });
            },
        },
    });

    var app_valves = new Vue({
        el: '#app-valves',
        data: {
            valves: [],
            checked: [],
        },
        methods: {
            reload: function() {
                get_valves();
            },
            on_change: function(port) {
                state = this.valves[port].result || false;
                post("/watering/valve/" + port + "/" + state).then(
                    x => get_state(x => get_valves())
                );
            },
            click: function(port) {
                state = this.valves[port].result || false;
                this.valves[port].result = !state;
                this.on_change(port);
            },
        },
    });

    var app_settings = new Vue({
        el: '#app-settings',
        data: {
            reboot_required: false,
            programs: [],
            valves_cfg: [],
            timezone_offset: 0,
            restart: {
                active: false,
                time: "23:59"
            },
            flow: {
                pin: 35,
                time_out: 1,
                time_base: 1000,
                max: -1,
                liter_ratio: 100
            },
        },
        methods: {
            reload_config: function() {
                get_valves_config(
                    x => get_reboot_config(
                        x => get_system_timezone(x => get_flow())
                    )
                );
            },
            save: function() {
                post("/system/reboot/config", {
                    reboot: this.restart,
                }).then(
                    x => post("/watering/valves/config", {
                        valves: this.valves_cfg,
                    }).then(
                        x => app_programs.save_programs().then(
                            x => post("/system/timezone", {
                                timezone_offset: this.timezone_offset,
                            }).then(
                                x => {
                                    if (this.reboot_required) {
                                        console.log("!!!reboot_required");
                                        this.reboot_required = false;
                                    }
                                    app_system.do_restart_hard().then(x => {
                                        console.log("reboot");
                                        app_busy.enter();
                                        setTimeout(function() {
                                            location.reload();
                                        }, 7000);
                                    });
                                })
                        )
                    )
                );
            },
            save_tz: function() {
                post("/system/timezone", {
                    timezone_offset: this.timezone_offset,
                }).then(
                    x => get_state()
                );
            },
            save_restart: function() {
                post("/system/reboot/config", {
                    reboot: this.restart,
                }).then(x => get_reboot_config());
            },
            save_flow: function() {
                post("/watering/flow/config", {
                    flow: this.flow,
                }).then(x => get_flow());
            },
            move_prog_valve: function(pos, d) {
                this.programs.forEach(prog => {
                    prog.tasks.forEach(task => {
                        v = task[pos];
                        task.splice(pos, 1);
                        task.splice(pos + d, 0, v);
                    });
                });
            },
            remove_prog_valve: function(pos, d) {
                this.programs.forEach(prog => {
                    prog.tasks.forEach(task => {
                        task.splice(pos, 1);
                    });
                });
            },
            add_prog_valve: function(pos, d) {
                this.programs.forEach(prog => {
                    prog.tasks.forEach(task => {
                        task.push(0);
                    });
                });
            },
            move: function(pos, d) {
                v = this.valves_cfg[pos];
                this.valves_cfg.splice(pos, 1);
                this.valves_cfg.splice(pos + d, 0, v);
                this.move_prog_valve(pos, d);

                this.reboot_required = true;
            },
            remove_port: function(pos) {
                this.valves_cfg.splice(pos, 1);
                this.remove_prog_valve(pos);

                this.reboot_required = true;
            },
            remove: function(pos) {
                confirm_delete("Port: " + (pos + 1), function() {
                    app_settings.remove_port(pos);
                });
            },
            add_port: function() {
                this.valves_cfg.push({
                    pin: 0,
                    name: "Port " + (this.valves_cfg.length + 1),
                    disabled: false,
                });
                this.add_prog_valve();
                console.log("todo adjust program");
            },
        },
    });


    var app_system = new Vue({
        el: '#app-system',
        data: {
            info: {},
        },
        methods: {
            reload: function() {
                get_system_info();
            },
            do_restart_hard: function() {
                return post("/system/reboot/hard", {});
            },
            restart_hard: function(pos) {
                confirm(null, "Restart", function() {
                    app_system.do_restart_hard();
                    setTimeout(function() {
                        console.log("reload page");
                        location.reload();
                    }, 10 * 1000);
                });
            },
            restart_soft: function(pos) {
                confirm(null, "Soft Restart", function() {
                    post("/system/reboot/modcore", {});
                });
            },
            gc: function() {
                get("/system/gc").then(function(obj) {
                    console.log("gc", obj);
                    app_system.reload();
                });
            },
        },
    })


    var app_license = new Vue({
        el: '#app-license',
        data: {
            "license_file": "",
            "license_valid": "01.01.2021",
            "licenses": [{
                    "name": "mpymodcore_watering",
                    "home": "https://github.com/kr-g/mpymodcore_watering",
                    "info": "https://github.com/kr-g/mpymodcore_watering/blob/master/LICENSE",
                    "type": "dual licensed"
                },
                {
                    "name": "mpymodcore",
                    "home": "https://github.com/kr-g/mpymodcore",
                    "info": "https://github.com/kr-g/mpymodcore/blob/master/LICENSE",
                    "type": "dual licensed"
                },
                {
                    "name": "fontawesome",
                    "home": "https://fontawesome.com/",
                    "info": "https://fontawesome.com/v4.7.0/license/",
                    "type": "MIT"
                },
                {
                    "name": "bootstrap",
                    "home": "https://getbootstrap.com/",
                    "info": "https://github.com/twbs/bootstrap/blob/master/LICENSE",
                    "type": "MIT"
                },
                {
                    "name": "jQuery",
                    "home": "https://jquery.com/",
                    "info": "https://github.com/jquery/jquery/blob/master/LICENSE.txt",
                    "type": "MIT"
                },
                {
                    "name": "Popper",
                    "home": "https://popper.js.org/",
                    "info": "https://github.com/popperjs/popper-core/blob/master/LICENSE.md",
                    "type": "MIT"
                },
                {
                    "name": "vuejs",
                    "home": "https://vuejs.org/",
                    "info": "https://github.com/vuejs/vuejs.org/blob/master/LICENSE",
                    "type": "MIT"
                },
            ]
        }
    });

    var state_loading = true;
    var ping_on = false;
    var ping_interval = 10 * 1000

    function ping(opt) {
        if (opt != undefined) {
            ping_on = opt;
        }
        get("/system/ping").then(obj => console.log(obj));
        if (ping_on) {
            timeoutID = window.setTimeout(ping, ping_interval);
        }
    }

    var active_tab = ["status-tab", null]

    function tab_events() {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            data = [e.target.id, e.relatedTarget.id]; // active, last active tab
            active_tab = data;
            console.log("tab changed", data);
        })
    }

    function get_all() {
        get_valves_config(
            x => get_valves(
                x => get_programs(
                    x => get_scheduled(
                        x => get_system_info(
                            x => get_reboot_config(
                                x => get_system_timezone(
                                    x => get_state(
                                        x => get_flow(x => state_loading = false)
                                    )
                                )
                            )
                        )
                    )
                )
            )
        );
    }

    $(document).ready(function() {

        app_status.auto_refresh = false;
        auto_refesh();
        auto_cur_time();
        tab_events();

        get_all();

        $('#myTab a[href="#status"]').tab('show');
    })
</script>

</html>



