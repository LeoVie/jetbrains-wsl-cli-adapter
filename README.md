# PhpStorm WSL CLI adapter

This script allows you to use the CLI of PhpStorm for Windows via WSL.

## Requirements
- PHPStorm installed via JetBrains Toolbox
- PHP >= 7.1

## Preparation
1. Open JetBrains Toolbox
2. Go to Settings
3. Enable "Tools" > "Generate shell scripts" and select a location for the generated shell scripts, e.g. `C:\jetbrains-shell-scripts\`
4. Check, if shell script for PhpStorm was generated (e.g. `C:\jetbrains-shell-scripts\PhpStorm.cmd`)
5. Clone this repository, e.g. to `/home/ubuntu/phpstorm-wsl-cli-adapter/`
6. Create alias (e.g. in `~/.bashrc`):
    `alias phpstorm='php /home/ubuntu/phpstorm-wsl-cli-adapter/phpstorm-wsl-cli-adapter.php "C:\jetbrains-shell-scripts\PhpStorm.cmd"'`
7. Re-source your file containing the alias (e.g. `source ~/.bashrc`)

## Usage
You should be able to use PhpStorm CLI from WSL shell. For example in this repository: `phpstorm README.md` should open the README.md in PhpStorm.