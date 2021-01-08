<template>
    <aside>
        <el-menu
            class="el-menu-vertical-demo"
            :default-active="$route.path"
            @open="handleOpen"
            @close="handleClose"
            @select="handleSelect"
            router
            :collapse="coreIsCollapsed"
        >
            <template
                v-for="(item,index) in admin_routes"
            >
                <el-menu-item
                    :route="item"
                    v-if="!item.children && !item.hidden"
                    :index="item.path"
                >
                    <i
                        :class="item.iconCls || 'el-icon-s-claim'"
                    ></i>

                    <span slot="title">
                        {{ $t(item.name) }}
                    </span>
                </el-menu-item>

                <el-submenu
                    :index="index+''"
                    v-if="item.children && !item.hidden"
                >
                    <template slot="title">
                        <i
                            :class="item.iconCls || 'el-icon-s-claim'"
                        ></i>

                        <span slot="title">
                            {{ item.name }}
                        </span>
                    </template>

                    <el-menu-item
                        v-for="child in item.children"
                        :route="child"
                        :index="child.path"
                        :key="child.path"
                    >
                        <span
                            slot="title"
                            v-if="!child.hidden"
                        >
                            {{ child.name }}
                        </span>
                    </el-menu-item>
                </el-submenu>
            </template>
        </el-menu>
    </aside>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "Sidebar",

        methods: {
            menuItemIsAvailable(item) {
                let allowed = !item.meta.hidden;

                if (allowed  && item.meta && item.meta.auth) {
                    allowed = this.$auth.check(item.meta.auth);
                }

                return allowed;
            },

            handleOpen() {
                // console.log('handleOpen');
            },

            handleClose() {
                // console.log('handleClose');
            },

            handleSelect: function () {
                // console.log('handleSelect');
            }
        },
        computed: {
            ...mapGetters([
                'coreIsCollapsed'
            ]),

            admin_routes() {
                return this.$router.options.routes[0].children;
            }
        }
    }
</script>
