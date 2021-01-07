
/**
 * Подключаю основные компоненты
 */
import Home from "./components/Home";
import Welcome from "./components/Welcome";
import Index from "./components/Index";
import NotFound from "./components/NotFound";
import auth from '../modules/auth/routes_auth';

/**
 * Подключаю динамически роуты из модулей
 */
const requireContext = require.context('../modules', true, /routes\.js$/);

const modules =
    requireContext
        .keys()
        .map(file =>
            [file.replace(/(^.\/)|(\.js$)/g, ''), requireContext(file)]
        );

let moduleRoutes = [];

for(let i in modules) {
    moduleRoutes = moduleRoutes.concat(modules[i][1].routes);
}

/**
 * Экспортирую роуты
 */
export const routes = [
    {
        path: '/admin',
        component: Home,
        children: [
            ...moduleRoutes,
        ]
    },
    {
        path: '/',
        component: Welcome,
        children: [
            {
                path: '/',
                component: Index,
                name: 'index',
            },
            ...auth,
            {
                path: '*',
                component: NotFound,
                name: 'not_found'
            }
        ]
    }
];
