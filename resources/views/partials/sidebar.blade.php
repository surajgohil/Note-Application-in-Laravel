<style>
    .sidebar {
        width: 100%;
        height: 100vh;
        background: #111827;
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 4px 0 15px rgba(0,0,0,.15);
    }

    .sidebar-sub-header {
        display: flex;
        justify-content: start;
        align-items: center;
        padding: 10%;
        height: 10vh;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .sidebar-sub-header h3 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
        letter-spacing: .5px;
    }

    .sidebar-menu {
        height: 80vh;
        overflow-y: scroll;
        padding: 20px 12px;
        flex: 1;
    }

    .sidebar-menu a,
    .sidebar-footer a {
        /* height: 10vh; */
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        /* margin-bottom: 8px; */
        color: #d1d5db;
        text-decoration: none;
        border-radius: 12px;
        transition: .3s;
        font-size: 15px;
        font-weight: 500;
    }

    .sidebar-menu a:hover,
    .sidebar-footer a:hover,
    .sidebar-menu a.active {
        /* background: #2563eb; */
        /* color: #fff; */
    }

    .sidebar-footer {
        height: 10%;
        border-top: 1px solid rgba(255,255,255,.08);
    }

    .sidebar-footer a {
        margin: 0px 10px;
        margin-top: 10px;
        color: #f87171;
    }

    .sidebar-footer a:hover {
        background: #dc2626;
        color: #fff;
    }
    .sidebar-header{
        height: 90%;
    }
</style>

<aside class="sidebar">

    <div class="sidebar-header">

        <div class="sidebar-sub-header">
            <h3 class="text-capitalize">{{ Auth::user()->name }}</h3>
        </div>

        <div class="sidebar-menu">
            <div>
                <a href="{{ route('dashboard') }}" class="border" data-toggle="modal" data-target="#folderFormModal">
                    ➕ Create New Folder
                </a>
            </div>

            <div id="folder-list-menu">

            </div>
        </div>

    </div>

    <div class="sidebar-footer">
        <a href="{{ route('logout') }}">
            🚪 Logout
        </a>
    </div>

</aside>
