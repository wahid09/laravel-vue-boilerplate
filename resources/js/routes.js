import Dashboard from './components/Dashboard.vue';
import ListDivisions from './pages/divisions/ListDivisions.vue';
import ListUnits from './pages/units/ListUnits.vue';

export default [
    {
        path: '/app/dashboard',
        name: 'app.dashboard',
        component: Dashboard,
    },
    {
        path: '/app/division',
        name: 'app.division',
        component: ListDivisions,
    },

    {
        path: '/app/unit',
        name: 'app.unit',
        component: ListUnits,
    }
]