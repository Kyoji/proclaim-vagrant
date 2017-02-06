# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

    config.vm.box = "ubuntu/trusty64"

    config.vm.network :private_network, id: "proclaim_primary", ip: "192.168.3.150"
    config.vm.hostname = "proclaim"

    config.vm.provider :virtualbox do |vb|
      proclaim_pwd = Dir.pwd
      vb.name = File.basename(proclaim_pwd)
    end

    if defined?(VagrantPlugins::HostsUpdater)
    config.hostsupdater.aliases = ["local.proclaim.dev"]
    config.hostsupdater.remove_on_suspend = true
    end

    config.vm.synced_folder "config/", "/srv/config/"
    config.vm.synced_folder "database/", "/srv/database/"
    config.vm.synced_folder "provision/", "/srv/provision/"
    config.vm.synced_folder "www/", "/var/www/"

    config.vm.provision :shell, path: "provision/provision.sh"

end