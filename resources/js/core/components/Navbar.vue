<template>
    <el-col
        :span="24"
        class="header"
    >
        <el-col
            :span="10"
            class="logo logo-width"
        >
            Admin Vue ElementUi
        </el-col>

        <el-col :span="10">
            <div class="tools">
                <i class="fa fa-align-justify"></i>
            </div>
        </el-col>

        <el-col
            :span="4"
            class="userinfo"
        >
            <el-dropdown
                trigger="hover"
            >
                <span
                    class="el-dropdown-link userinfo-inner"
                >
                    <img
                        :src="sysUserAvatar"
                    />
                    {{ sysUserName }}
                </span>

                <el-dropdown-menu
                    slot="dropdown"
                >
                    <el-dropdown-item
                        divided
                        @click.native="logout"
                        dusk="logout"
                    >
                        logout
                    </el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </el-col>
    </el-col>
</template>

<script>
    export default {
        name: "Navbar",
        data: () => ({
            sysUserName: 'pahomovdima',
            sysUserAvatar: ''
        }),
    }
</script>

<style scoped>

</style>