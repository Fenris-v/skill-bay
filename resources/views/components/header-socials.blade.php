<div class="row-block hide_700">
    <span class="ControlPanel-title">Мы в соцсетях</span>
    <ul class="menu menu_img menu_smallImg ControlPanel-menu">
        <li class="menu-item">
            <a class="menu-link" href="{{ $configs->getFacebook() }}"
               target="_blank" rel="nofollow noopener">
                <x-icons.social-header.fb />
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="{{ $configs->getTwitter() }}"
               target="_blank" rel="nofollow noopener">
                <x-icons.social-header.twitter />
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="{{ $configs->getLinkedin() }}"
               target="_blank" rel="nofollow noopener">
                <x-icons.social-header.insta />
            </a>
        </li>
    </ul>
</div>
